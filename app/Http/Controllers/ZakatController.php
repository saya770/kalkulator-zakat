<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZakatController extends Controller
{
    /**
     * Nisab values in IDR (updated rates)
     */
    private const GOLD_NISAB = 85; // grams
    private const SILVER_NISAB = 595; // grams
    private const CURRENT_GOLD_PRICE = 720000; // IDR per gram
    private const CURRENT_SILVER_PRICE = 10500; // IDR per gram
    private const ZAKAT_RATE = 0.025; // 2.5%

    public function index()
    {
        $zakats = session()->get('zakats', []);
        return view('zakat.index', compact('zakats'));
    }

    public function create()
    {
        return view('zakat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:100',
            'zakat_type' => 'required|in:income,wealth',
            'income' => 'nullable|numeric|min:0',
            'cash' => 'nullable|numeric|min:0',
            'savings' => 'nullable|numeric|min:0',
            'gold_weight' => 'nullable|numeric|min:0',
            'silver_weight' => 'nullable|numeric|min:0',
            'animals' => 'nullable|numeric|min:0',
            'trade_goods' => 'nullable|numeric|min:0',
        ]);

        // Set default 0 untuk nilai yang kosong
        $validated['income'] = $validated['income'] ?? 0;
        $validated['cash'] = $validated['cash'] ?? 0;
        $validated['savings'] = $validated['savings'] ?? 0;
        $validated['gold_weight'] = $validated['gold_weight'] ?? 0;
        $validated['silver_weight'] = $validated['silver_weight'] ?? 0;
        $validated['animals'] = $validated['animals'] ?? 0;
        $validated['trade_goods'] = $validated['trade_goods'] ?? 0;

        $zakatCalculation = $this->calculateZakat($validated);
        
        // Generate unique ID untuk session
        $id = time() . rand(1000, 9999);
        $zakatCalculation['id'] = $id;
        $zakatCalculation['created_at'] = now();

        // Simpan ke session
        $zakats = session()->get('zakats', []);
        $zakats[$id] = $zakatCalculation;
        session()->put('zakats', $zakats);
        
        return redirect()->route('zakat.show', $id)->with('success', 'Perhitungan zakat berhasil disimpan!');
    }

    public function show($id)
    {
        $zakats = session()->get('zakats', []);
        
        if (!isset($zakats[$id])) {
            return redirect()->route('zakat.index')->with('error', 'Perhitungan zakat tidak ditemukan!');
        }
        
        $zakat = $zakats[$id];
        return view('zakat.show', compact('zakat', 'id'));
    }

    public function edit($id)
    {
        $zakats = session()->get('zakats', []);
        
        if (!isset($zakats[$id])) {
            return redirect()->route('zakat.index')->with('error', 'Perhitungan zakat tidak ditemukan!');
        }
        
        $zakat = $zakats[$id];
        return view('zakat.edit', compact('zakat', 'id'));
    }

    public function update(Request $request, $id)
    {
        $zakats = session()->get('zakats', []);
        
        if (!isset($zakats[$id])) {
            return redirect()->route('zakat.index')->with('error', 'Perhitungan zakat tidak ditemukan!');
        }

        $validated = $request->validate([
            'name' => 'nullable|string|max:100',
            'zakat_type' => 'required|in:income,wealth',
            'income' => 'nullable|numeric|min:0',
            'cash' => 'nullable|numeric|min:0',
            'savings' => 'nullable|numeric|min:0',
            'gold_weight' => 'nullable|numeric|min:0',
            'silver_weight' => 'nullable|numeric|min:0',
            'animals' => 'nullable|numeric|min:0',
            'trade_goods' => 'nullable|numeric|min:0',
        ]);

        // Set default 0 untuk nilai yang kosong
        $validated['income'] = $validated['income'] ?? 0;
        $validated['cash'] = $validated['cash'] ?? 0;
        $validated['savings'] = $validated['savings'] ?? 0;
        $validated['gold_weight'] = $validated['gold_weight'] ?? 0;
        $validated['silver_weight'] = $validated['silver_weight'] ?? 0;
        $validated['animals'] = $validated['animals'] ?? 0;
        $validated['trade_goods'] = $validated['trade_goods'] ?? 0;

        $zakatCalculation = $this->calculateZakat($validated);
        $zakatCalculation['id'] = $id;
        $zakatCalculation['created_at'] = $zakats[$id]['created_at'] ?? now();

        $zakats[$id] = $zakatCalculation;
        session()->put('zakats', $zakats);
        
        return redirect()->route('zakat.show', $id)->with('success', 'Perhitungan zakat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $zakats = session()->get('zakats', []);
        
        if (isset($zakats[$id])) {
            unset($zakats[$id]);
            session()->put('zakats', $zakats);
        }
        
        return redirect()->route('zakat.index')->with('success', 'Perhitungan zakat berhasil dihapus!');
    }

    private function calculateZakat($data)
    {
        $type = $data['zakat_type'] ?? 'wealth';
        $income = $data['income'] ?? 0;
        $cash = $data['cash'] ?? 0;
        $savings = $data['savings'] ?? 0;
        $goldWeight = $data['gold_weight'] ?? 0;
        $silverWeight = $data['silver_weight'] ?? 0;
        $animals = $data['animals'] ?? 0;
        $tradeGoods = $data['trade_goods'] ?? 0;

        if ($type === 'income') {
            // Zakat Penghasilan: 2.5% dari penghasilan
            $zakatAmount = $income * self::ZAKAT_RATE;
            $totalAsset = $income;
            $nisab = $income * 0.025;
        } else {
            // Zakat Harta: Harus mencapai nisab terlebih dahulu
            $goldValue = $goldWeight * self::CURRENT_GOLD_PRICE;
            $silverValue = $silverWeight * self::CURRENT_SILVER_PRICE;
            $totalAsset = $cash + $savings + $goldValue + $silverValue + $animals + $tradeGoods;
            
            // Nisab diambil dari nilai emas atau perak yang lebih rendah
            $goldNisab = self::GOLD_NISAB * self::CURRENT_GOLD_PRICE;
            $silverNisab = self::SILVER_NISAB * self::CURRENT_SILVER_PRICE;
            $nisab = min($goldNisab, $silverNisab);

            if ($totalAsset >= $nisab) {
                $zakatAmount = $totalAsset * self::ZAKAT_RATE;
            } else {
                $zakatAmount = 0;
            }
        }

        return [
            'name' => $data['name'] ?? null,
            'income' => $income,
            'cash' => $cash,
            'savings' => $savings,
            'gold_weight' => $goldWeight,
            'silver_weight' => $silverWeight,
            'animals' => $animals,
            'trade_goods' => $tradeGoods,
            'total_asset' => $totalAsset,
            'nisab' => $nisab,
            'zakat_amount' => $zakatAmount,
            'zakat_type' => $type,
        ];
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'zakat_type' => 'required|in:income,wealth',
            'income' => 'nullable|numeric|min:0',
            'cash' => 'nullable|numeric|min:0',
            'savings' => 'nullable|numeric|min:0',
            'gold_weight' => 'nullable|numeric|min:0',
            'silver_weight' => 'nullable|numeric|min:0',
            'animals' => 'nullable|numeric|min:0',
            'trade_goods' => 'nullable|numeric|min:0',
        ]);

        $result = $this->calculateZakat($validated);
        return response()->json($result);
    }
}
