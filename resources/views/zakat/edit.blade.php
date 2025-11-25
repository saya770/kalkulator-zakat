@extends('layouts.app')

@section('title', 'Edit Perhitungan Zakat')

@section('content')
    <h2>Edit Perhitungan Zakat</h2>

    <div class="info-box">
        <strong>ℹ️ Informasi:</strong> Ubah data perhitungan zakat Anda di bawah ini
    </div>

    <form action="{{ route('zakat.update', $id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama/Keterangan (Opsional)</label>
            <input type="text" id="name" name="name" placeholder="Contoh: Zakat 2025 saya" value="{{ old('name', $zakat['name']) }}">
        </div>

        <div class="form-group">
            <label for="zakat_type">Tipe Zakat <span style="color: red;">*</span></label>
            <select id="zakat_type" name="zakat_type" required onchange="toggleZakatType()">
                <option value="income" @if(old('zakat_type', $zakat['zakat_type']) === 'income') selected @endif>Zakat Penghasilan (2.5% dari upah/bisnis)</option>
                <option value="wealth" @if(old('zakat_type', $zakat['zakat_type']) === 'wealth') selected @endif>Zakat Harta (2.5% dari aset yang disimpan setahun)</option>
            </select>
        </div>

        <!-- Zakat Penghasilan -->
        <div id="income-section" style="display: none;">
            <h3>💼 Zakat Penghasilan</h3>
            <p style="color: #666; margin-bottom: 20px;">Masukkan penghasilan Anda dari upah kerja atau bisnis</p>
            
            <div class="form-group">
                <label for="income">Penghasilan Bulanan/Tahunan (Rp)</label>
                <input type="number" id="income" name="income" placeholder="0" value="{{ old('income', $zakat['income']) }}" step="0.01" min="0">
            </div>
        </div>

        <!-- Zakat Harta -->
        <div id="wealth-section" style="display: none;">
            <h3>🏦 Zakat Harta</h3>
            <p style="color: #666; margin-bottom: 20px;">Masukkan seluruh harta yang telah disimpan selama setahun penuh</p>

            <h4 style="margin-top: 30px; margin-bottom: 15px;">💰 Uang & Tabungan</h4>
            <div class="form-row">
                <div class="form-group">
                    <label for="cash">Uang Tunai (Rp)</label>
                    <input type="number" id="cash" name="cash" placeholder="0" value="{{ old('cash', $zakat['cash']) }}" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label for="savings">Tabungan/Rekening Bank (Rp)</label>
                    <input type="number" id="savings" name="savings" placeholder="0" value="{{ old('savings', $zakat['savings']) }}" step="0.01" min="0">
                </div>
            </div>

            <h4 style="margin-top: 30px; margin-bottom: 15px;">🏆 Emas & Perak</h4>
            <div class="form-row">
                <div class="form-group">
                    <label for="gold_weight">Berat Emas (Gram)</label>
                    <input type="number" id="gold_weight" name="gold_weight" placeholder="0" value="{{ old('gold_weight', $zakat['gold_weight']) }}" step="0.01" min="0">
                    <small style="color: #999;">Harga emas: Rp 720.000/gram</small>
                </div>
                <div class="form-group">
                    <label for="silver_weight">Berat Perak (Gram)</label>
                    <input type="number" id="silver_weight" name="silver_weight" placeholder="0" value="{{ old('silver_weight', $zakat['silver_weight']) }}" step="0.01" min="0">
                    <small style="color: #999;">Harga perak: Rp 10.500/gram</small>
                </div>
            </div>

            <h4 style="margin-top: 30px; margin-bottom: 15px;">🐑 Harta Lainnya</h4>
            <div class="form-row">
                <div class="form-group">
                    <label for="animals">Nilai Hewan Ternak (Rp)</label>
                    <input type="number" id="animals" name="animals" placeholder="0" value="{{ old('animals', $zakat['animals']) }}" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label for="trade_goods">Nilai Barang Dagangan (Rp)</label>
                    <input type="number" id="trade_goods" name="trade_goods" placeholder="0" value="{{ old('trade_goods', $zakat['trade_goods']) }}" step="0.01" min="0">
                </div>
            </div>
        </div>

        <div class="button-group" style="margin-top: 30px;">
            <button type="submit">💾 Perbarui Perhitungan</button>
            <a href="{{ route('zakat.show', $id) }}" style="padding: 12px 30px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; display: inline-block;">Batal</a>
        </div>
    </form>

    <script>
        function toggleZakatType() {
            const type = document.getElementById('zakat_type').value;
            document.getElementById('income-section').style.display = type === 'income' ? 'block' : 'none';
            document.getElementById('wealth-section').style.display = type === 'wealth' ? 'block' : 'none';
        }

        // Trigger on page load
        document.addEventListener('DOMContentLoaded', toggleZakatType);
    </script>
@endsection
