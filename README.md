# PT Borneo Iban Jaya Perkasa (Web Application)

Website resmi untuk PT Borneo Iban Jaya Perkasa - Spesialis Jasa Fabrikasi Logam, Potong, Plong & Tekuk Plat di Sidoarjo & Surabaya.

## 👨‍💻 Developer Info
- **Original Developer:** Firman
- **Re-edit & Maintenance:** Ilhamm

## 🚀 Fitur & Optimasi Terkini
- **Company Profile:** Informasi layanan, produk, dan portofolio perusahaan.
- **Dynamic Content:** Blog, Testimonial, dan manajemen homepage section melalui admin panel.
- **Performance Optimized (PageSpeed Green):** 
  - GZIP compression & Browser Caching aktif via `.htaccess`
  - Gambar besar dikonversi ke format WebP
  - Lazy Loading untuk semua gambar di-bawah-layar (below-the-fold)
  - Defer loading untuk JavaScript pihak ketiga dan plugin
  - CSS inti diminifikasi (`style.min.css`)
  - SVG loader ringan (1.4KB)
- **SEO Ready:** Konfigurasi Meta Title, Description, dan OpenGraph yang sudah bersih dan rapi via `Artesaos SEOTools`.

## 🛠️ Stack Teknologi
- **Framework:** Laravel
- **Frontend:** Bootstrap, Swiper.js, AOS (Animasi)
- **Database:** MySQL

## ⚙️ Cara Instalasi (Local Development)

1. Clone repositori ini ke komputer lokal:
   ```bash
   git clone https://github.com/dgtilhammln-cmd/ptborneoibanjayaperkasa.id.git
   ```
2. Copy file `.env.example` menjadi `.env` dan sesuaikan konfigurasi koneksi database.
3. Install dependensi PHP:
   ```bash
   composer install
   ```
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

## 📦 Cara Deployment ke Server Hostinger

Setiap ada update kode terbaru di GitHub, jalankan perintah sakti ini di terminal SSH server Hostinger Anda untuk mensinkronisasi dan membersihkan cache:

```bash
cd /home/u664715641/domains/ptborneoibanjayaperkasa.id/public_html
git fetch origin main
git reset --hard FETCH_HEAD
php artisan config:clear
php artisan config:cache
php artisan view:cache
```

---
*Dokumentasi ini diperbarui untuk mencatat seluruh perbaikan performa dan SEO yang dilakukan oleh Ilhamm.*
