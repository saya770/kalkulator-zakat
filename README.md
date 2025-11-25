# 📱 Kalkulator Zakat

Aplikasi web untuk menghitung zakat penghasilan dan zakat harta dengan mudah dan akurat.

## ✨ Fitur

### 💼 Zakat Penghasilan
- Hitung 2.5% dari penghasilan kerja/bisnis
- Input fleksibel (bulanan/tahunan)
- Hasil perhitungan instan

### 🏦 Zakat Harta
- Hitung 2.5% dari total harta yang disimpan
- Dukungan berbagai jenis harta:
  - 💰 Uang tunai & tabungan bank
  - 🏆 Emas & perak (dengan konversi harga otomatis)
  - 🐑 Hewan ternak
  - 📦 Barang dagangan
- Pengecekan nisab otomatis
- Perhitungan nilai emas/perak berdasarkan harga terkini

### 📊 Manajemen Data
- ✅ Buat perhitungan zakat baru
- 👀 Lihat detail perhitungan
- ✏️ Edit perhitungan yang sudah ada
- 🗑️ Hapus perhitungan
- 📋 Daftar semua perhitungan

### 🎨 Interface
- Desain modern dengan gradient purple
- Responsif (mobile-friendly)
- User-friendly dengan emoji indicators
- Navigasi intuitif

## 🚀 Teknologi

- **Framework**: Laravel 12
- **Backend**: PHP 8.2+
- **Frontend**: Blade Templates + CSS3
- **Storage**: Session-based (file storage)
- **Database**: ❌ Tidak memerlukan database

## 📋 Persyaratan

- PHP >= 8.2
- Composer
- Git (untuk development)

## 🔧 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/saya770/kalkulator-zakat.git
cd kalkulator-zakat
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Jalankan Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📖 Cara Menggunakan

### Hitung Zakat Penghasilan
1. Buka aplikasi di browser
2. Klik **"Hitung Zakat Baru"**
3. Pilih **"Zakat Penghasilan"**
4. Masukkan jumlah penghasilan Anda
5. Klik **"Hitung & Simpan"**
6. Lihat hasil perhitungan zakat

### Hitung Zakat Harta
1. Buka aplikasi di browser
2. Klik **"Hitung Zakat Baru"**
3. Pilih **"Zakat Harta"**
4. Masukkan data harta Anda:
   - Uang tunai
   - Tabungan bank
   - Berat emas (gram)
   - Berat perak (gram)
   - Nilai hewan ternak
   - Nilai barang dagangan
5. Klik **"Hitung & Simpan"**
6. Aplikasi akan:
   - Menghitung total harta
   - Cek apakah mencapai nisab
   - Hitung 2.5% zakat yang wajib dikeluarkan

## 💾 Penyimpanan Data

Aplikasi menggunakan **session-based storage**:

### Keuntungan:
✅ Tidak perlu database
✅ Lebih ringan dan cepat
✅ Deploy lebih mudah
✅ Privasi terjaga (data lokal)

### Catatan:
⚠️ Data tersimpan **per browser session**
⚠️ Data hilang jika browser ditutup atau session expired
⚠️ Data tidak tersimpan permanen di server

Untuk penyimpanan permanen, bisa tambahkan fitur database di masa depan.

## 📊 Kalkulasi Zakat

### Formula Zakat Penghasilan
```
Zakat = Penghasilan × 2.5%
```

### Formula Zakat Harta
```
Total Harta = Uang Tunai + Tabungan + (Emas(gram) × 720,000) 
            + (Perak(gram) × 10,500) + Hewan Ternak + Barang Dagangan

Nisab = min(85 gram × 720,000; 595 gram × 10,500) 
      = min(61,200,000; 6,247,500) 
      = 6,247,500

Jika Total Harta >= Nisab:
  Zakat = Total Harta × 2.5%
Jika Total Harta < Nisab:
  Zakat = 0
```

## 🔐 Keamanan

- Input validation di semua form
- CSRF protection aktif
- XSS protection
- Data tidak tersimpan di database (lebih aman)

## 📁 Struktur Project

```
kalkulator-zakat/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ZakatController.php
│   └── Models/
│       └── Zakat.php (reference only)
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       └── zakat/
│           ├── create.blade.php
│           ├── edit.blade.php
│           ├── index.blade.php
│           └── show.blade.php
├── routes/
│   └── web.php
├── storage/
│   ├── framework/
│   │   ├── sessions/    (session files)
│   │   └── cache/       (cache files)
│   └── logs/
└── public/
    └── index.php
```

## 🛣️ Routes

| Method | URL | Controller | Deskripsi |
|--------|-----|-----------|-----------|
| GET | `/zakat` | ZakatController@index | Daftar perhitungan |
| GET | `/zakat/create` | ZakatController@create | Form buat perhitungan |
| POST | `/zakat` | ZakatController@store | Simpan perhitungan baru |
| GET | `/zakat/{id}` | ZakatController@show | Detail perhitungan |
| GET | `/zakat/{id}/edit` | ZakatController@edit | Form edit perhitungan |
| PUT | `/zakat/{id}` | ZakatController@update | Update perhitungan |
| DELETE | `/zakat/{id}` | ZakatController@destroy | Hapus perhitungan |

## 🐛 Troubleshooting

### Session tidak tersimpan?
- Pastikan folder `/storage/framework/sessions/` writable
- Run: `php artisan storage:link`

### Halaman error saat submit?
- Clear cache: `php artisan cache:clear`
- Clear view: `php artisan view:clear`
- Clear config: `php artisan config:clear`

### Port 8000 sudah digunakan?
```bash
php artisan serve --port=8001
```

## 🔄 Development

### Setup untuk development
```bash
# Install dependencies
composer install

# Generate APP_KEY
php artisan key:generate

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Start server
php artisan serve
```

### Testing
```bash
php artisan test
```

## 📝 License

MIT License - Bebas digunakan untuk keperluan apapun

## 👨‍💻 Author

**saya770**
- GitHub: [@saya770](https://github.com/saya770)

## 📞 Support

Jika menemukan bug atau ada pertanyaan, bisa buka issue di repository ini.

## 🙏 Doa

> "Semoga zakat kita diterima oleh Allah SWT dan membawa berkah bagi yang membutuhkan. Amin 🤲"

---

**Dibuat dengan ❤️ untuk memudahkan perhitungan zakat di era digital**
