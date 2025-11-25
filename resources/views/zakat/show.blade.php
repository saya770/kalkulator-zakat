@extends('layouts.app')

@section('title', 'Detail Perhitungan Zakat')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Detail Perhitungan Zakat</h2>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('zakat.edit', $id) }}" style="padding: 10px 20px; background: #17a2b8; color: white; text-decoration: none; border-radius: 5px;">✏️ Edit</a>
            <form action="{{ route('zakat.destroy', $id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                @csrf
                @method('DELETE')
                <button type="submit" style="padding: 10px 20px; background: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">🗑️ Hapus</button>
            </form>
        </div>
    </div>

    <div class="result-box">
        <h3>📋 Informasi Perhitungan</h3>
        <div class="result-item">
            <strong>Nama/Keterangan:</strong>
            <span>{{ $zakat['name'] ?? 'Perhitungan #' . $id }}</span>
        </div>
        <div class="result-item">
            <strong>Tipe Zakat:</strong>
            <span>{{ $zakat['zakat_type'] === 'income' ? 'Zakat Penghasilan' : 'Zakat Harta' }}</span>
        </div>
        <div class="result-item">
            <strong>Tanggal Perhitungan:</strong>
            <span>{{ $zakat['created_at']->format('d MMMM Y H:i') }}</span>
        </div>
    </div>

    @if($zakat['zakat_type'] === 'income')
        <!-- Zakat Penghasilan -->
        <div class="result-box">
            <h3>💼 Detail Zakat Penghasilan</h3>
            <div class="result-item">
                <strong>Penghasilan:</strong>
                <span>Rp {{ number_format($zakat['income'], 0, ',', '.') }}</span>
            </div>
            <div class="result-item">
                <strong>Tarif Zakat:</strong>
                <span>2.5%</span>
            </div>
        </div>
    @else
        <!-- Zakat Harta -->
        <div class="result-box">
            <h3>🏦 Detail Zakat Harta</h3>
            
            <h4 style="margin: 20px 0 15px 0; color: #333;">Komponen Harta:</h4>
            
            <div class="result-item">
                <strong>💰 Uang Tunai:</strong>
                <span>Rp {{ number_format($zakat['cash'], 0, ',', '.') }}</span>
            </div>
            <div class="result-item">
                <strong>🏦 Tabungan/Bank:</strong>
                <span>Rp {{ number_format($zakat['savings'], 0, ',', '.') }}</span>
            </div>

            @if($zakat['gold_weight'] > 0 || $zakat['silver_weight'] > 0)
                <div class="result-item">
                    <strong>🏆 Emas:</strong>
                    <span>{{ $zakat['gold_weight'] }} gram = Rp {{ number_format($zakat['gold_weight'] * 720000, 0, ',', '.') }}</span>
                </div>
                <div class="result-item">
                    <strong>🥈 Perak:</strong>
                    <span>{{ $zakat['silver_weight'] }} gram = Rp {{ number_format($zakat['silver_weight'] * 10500, 0, ',', '.') }}</span>
                </div>
            @endif

            @if($zakat['animals'] > 0)
                <div class="result-item">
                    <strong>🐑 Hewan Ternak:</strong>
                    <span>Rp {{ number_format($zakat['animals'], 0, ',', '.') }}</span>
                </div>
            @endif

            @if($zakat['trade_goods'] > 0)
                <div class="result-item">
                    <strong>📦 Barang Dagangan:</strong>
                    <span>Rp {{ number_format($zakat['trade_goods'], 0, ',', '.') }}</span>
                </div>
            @endif

            <div class="result-item" style="border-top: 2px solid #ddd; padding-top: 15px; margin-top: 15px;">
                <strong style="font-size: 16px;">Total Harta Zakatnya:</strong>
                <span style="font-size: 16px; font-weight: bold;">Rp {{ number_format($zakat['total_asset'], 0, ',', '.') }}</span>
            </div>

            <div class="result-item">
                <strong>Nisab (batas minimum zakat):</strong>
                <span>Rp {{ number_format($zakat['nisab'], 0, ',', '.') }}</span>
            </div>

            @if($zakat['total_asset'] >= $zakat['nisab'])
                <div style="background: #d4edda; padding: 15px; border-radius: 5px; margin-top: 15px; border-left: 4px solid #28a745;">
                    <strong style="color: #155724;">✅ HARTA WAJIB ZAKAT</strong>
                    <p style="color: #155724; margin-top: 10px;">Harta Anda telah mencapai nisab, sehingga zakat wajib dikeluarkan.</p>
                </div>
            @else
                <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin-top: 15px; border-left: 4px solid #ffc107;">
                    <strong style="color: #856404;">ℹ️ BELUM MENCAPAI NISAB</strong>
                    <p style="color: #856404; margin-top: 10px;">Harta Anda belum mencapai nisab. Anda baru wajib zakat ketika harta mencapai Rp {{ number_format($zakat['nisab'], 0, ',', '.') }}</p>
                </div>
            @endif
        </div>
    @endif

    <!-- Hasil Akhir -->
    <div class="zakat-total">
        <h4>📊 HASIL PERHITUNGAN ZAKAT ANDA</h4>
        <div style="font-size: 28px; color: #155724; font-weight: bold; margin: 20px 0;">
            Rp {{ number_format($zakat['zakat_amount'], 0, ',', '.') }}
        </div>
        <p style="color: #155724; margin-top: 15px;">
            @if($zakat['zakat_amount'] > 0)
                Jumlah ini adalah 2.5% dari total {{ $zakat['zakat_type'] === 'income' ? 'penghasilan' : 'harta zakatnya' }} Anda yang wajib dikeluarkan sebagai zakat.
            @else
                Belum ada zakat yang wajib dikeluarkan.
            @endif
        </p>
    </div>

    <div style="margin-top: 30px; padding: 20px; background: #e7f3ff; border-left: 4px solid #2196F3; border-radius: 3px; color: #31708f;">
        <strong>💡 Tips Mengeluarkan Zakat:</strong>
        <ul style="margin-top: 10px; margin-left: 20px;">
            <li>Zakat dapat dikeluarkan langsung kepada yang berhak atau melalui lembaga zakat terpercaya</li>
            <li>Pastikan niat ikhlas dan untuk mencari rida Allah SWT</li>
            <li>Zakat harta wajib dikeluarkan setelah 1 tahun hijriyah (haul)</li>
            <li>Konsultasikan dengan ustaz/ustazah setempat untuk memastikan perhitungan yang akurat</li>
        </ul>
    </div>

    <div class="button-group" style="margin-top: 30px;">
        <a href="{{ route('zakat.index') }}" style="padding: 12px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; display: inline-block;">← Kembali ke Daftar</a>
        <a href="{{ route('zakat.create') }}" style="padding: 12px 30px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; display: inline-block;">+ Hitung Zakat Baru</a>
    </div>
@endsection
