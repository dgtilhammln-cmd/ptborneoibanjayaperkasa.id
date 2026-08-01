<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class WebsiteContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Contact Info & Company Profile (Settings)
        $settings = [
            'site_name' => ['group' => 'general', 'value' => 'PT. Borneo Iban Jaya Perkasa', 'type' => 'text'],
            'contact_phone' => ['group' => 'contact', 'value' => '031-8559-7449 / 0895-1553-2597', 'type' => 'text'],
            'contact_email' => ['group' => 'contact', 'value' => 'bigjaya503@gmail.com', 'type' => 'text'],
            'contact_address' => ['group' => 'contact', 'value' => 'Jl. Ngingas Selatan No. 29, RT. 002, RW. 001, Ngingas Waru, Sidoarjo, Jawa Timur', 'type' => 'text'],
            'home_welcome_text' => ['group' => 'home', 'value' => 'Jasa Bubut, Stamping, Moulding & Sparepart Berkualitas Tinggi', 'type' => 'text'],
            'company_about' => ['group' => 'about', 'value' => 'PT. Borneo Iban Jaya Perkasa adalah perusahaan yang bergerak di bidang jasa logam, plong, dan produksi aksesori serta suku cadang berkualitas tinggi. Berlokasi di Sidoarjo, Jawa Timur, perusahaan ini menawarkan berbagai layanan dan produk untuk memenuhi kebutuhan industri dan otomotif. Kami melayani kontraktor industri, perdagangan, dan jasa potong, plong, tekuk, serta tiruskan pipa sesuai kebutuhan pelanggan.', 'type' => 'text'],
            'company_vision' => ['group' => 'about', 'value' => 'Menjadi perusahaan industri dan jasa yang mampu bersaing dan berkembang dengan sehat, mengutamakan pelayanan, mutu, dan reputasi global.', 'type' => 'text'],
            'company_mission' => [
                'group' => 'about',
                'value' => json_encode([
                    'Menyediakan produk dan jasa berkualitas tinggi yang memenuhi kebutuhan pelanggan melalui program pemasaran terbaik',
                    'Mengembangkan karyawan berkompeten dengan menciptakan lingkungan kerja yang mendukung kepuasan pelanggan',
                    'Memperkuat kolaborasi dengan pemasok dan distributor melalui komunikasi dan kerja sama yang lebih baik',
                    'Menyeimbangkan pencapaian perusahaan dalam peningkatan profit, sumber daya manusia, dan lingkungan'
                ]),
                'type' => 'json'
            ],
            'home_slider_images' => [
                'group' => 'home',
                'value' => json_encode([
                    'https://www.ptborneoibanjayaperkasa.com/images/1606376792-9ab0d_images.jpg',
                    'https://www.ptborneoibanjayaperkasa.com/images/1606376792-d4ede_images.jpg',
                    'https://www.ptborneoibanjayaperkasa.com/images/1606376854-31199_DSCF0426.JPG',
                ]),
                'type' => 'json'
            ],
        ];

        foreach ($settings as $key => $data) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                [
                    'value' => $data['value'],
                    'type' => $data['type'],
                    'group' => $data['group'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 2. Services
        $scrapedServices = [
            ['name' => 'Jasa Bubut', 'slug' => 'jasa-bubut', 'description' => 'Layanan bubut presisi tinggi untuk berbagai komponen logam dengan akurasi dan kualitas terjamin sesuai kebutuhan industri Anda.', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/jasa-bubut.jpg'],
            ['name' => 'Jasa Stamping', 'slug' => 'jasa-stamping', 'description' => 'Layanan stamping untuk produksi komponen logam dengan presisi tinggi, cocok untuk kebutuhan otomotif dan industri.', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/jasa-stamping.jpg'],
            ['name' => 'Jasa Moulding', 'slug' => 'jasa-moulding', 'description' => 'Layanan moulding untuk pembuatan komponen dengan berbagai bentuk dan ukuran sesuai spesifikasi yang dibutuhkan.', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/jasa-moulding.jpg'],
            ['name' => 'Jasa Plong', 'slug' => 'jasa-plong', 'description' => 'Layanan jasa plong/punching untuk pembuatan lubang dan bentuk pada material logam dengan presisi tinggi.', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/jasa-plong.jpg'],
            ['name' => 'Jasa Potong', 'slug' => 'jasa-potong', 'description' => 'Layanan jasa potong logam dengan berbagai metode sesuai kebutuhan, termasuk potong pipa dan material lainnya.', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/jasa-potong.jpg'],
            ['name' => 'Jasa Tekuk', 'slug' => 'jasa-tekuk', 'description' => 'Layanan jasa tekuk logam profesional dengan presisi tinggi untuk berbagai kebutuhan industri dan otomotif.', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/jasa-tekuk.jpg'],
            ['name' => 'Jasa Tirus Pipa', 'slug' => 'jasa-tirus-pipa', 'description' => 'Layanan jasa tiruskan pipa untuk berbagai aplikasi industri dengan hasil yang presisi dan berkualitas.', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/jasa-tirus-pipa.jpg'],
        ];

        foreach ($scrapedServices as $item) {
            Service::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'image' => $item['image'],
                ]
            );
        }

        // 3. Products
        $scrapedProducts = [
            ['name' => 'Pedal Rem Belakang Crypton', 'slug' => 'pedal-rem-belakang-crypton', 'description' => 'Pedal rem belakang berkualitas tinggi untuk sepeda motor Crypton. Berfungsi sebagai komponen input untuk mengaktifkan sistem pengereman dengan desain yang sesuai untuk motor bebek.', 'price' => 'Hubungi Kami', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/pedal-rem-crypton.jpg'],
            ['name' => 'Pedal Rem Belakang Vega R', 'slug' => 'pedal-rem-belakang-vega-r', 'description' => 'Pedal rem belakang untuk Vega R Old dan Vega R New dengan kualitas terjamin dan tahan lama.', 'price' => 'Hubungi Kami', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/pedal-rem-vega-r.jpg'],
            ['name' => 'Pedal Rem Belakang Jupiter', 'slug' => 'pedal-rem-belakang-jupiter', 'description' => 'Pedal rem belakang untuk sepeda motor Jupiter dengan desain yang sesuai dan berkualitas tinggi.', 'price' => 'Hubungi Kami', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/pedal-rem-jupiter.jpg'],
            ['name' => 'Bracket TV LED', 'slug' => 'bracket-tv-led', 'description' => 'Bracket TV LED yang didesain untuk mendukung pemasangan TV LED dengan kokoh dan aman. Terbuat dari material berkualitas tinggi.', 'price' => 'Hubungi Kami', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/bracket-tv-led.jpg'],
            ['name' => 'Bracket AC / Pangkon AC', 'slug' => 'bracket-ac-pangkon-ac', 'description' => 'Bracket AC atau Pangkon AC berkualitas tinggi untuk instalasi AC. Tersedia dalam berbagai ukuran sesuai kebutuhan.', 'price' => 'Hubungi Kami', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/bracket-ac.jpg'],
            ['name' => 'Pangkon Plat Nomor Mobil', 'slug' => 'pangkon-plat-nomor-mobil', 'description' => 'Pangkon plat nomor mobil berbahan stainless atau besi dengan kualitas terjamin dan tahan karat.', 'price' => 'Hubungi Kami', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/pangkon-plat-nomor.jpg'],
            ['name' => 'T-Handle Tojok', 'slug' => 't-handle-tojok', 'description' => 'T-Handle Tojok berkualitas tinggi untuk berbagai kebutuhan industri dan otomotif.', 'price' => 'Hubungi Kami', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/t-handle-tojok.jpg'],
            ['name' => 'Klem Gala', 'slug' => 'klem-gala', 'description' => 'Klem Gala dengan kualitas terjamin untuk berbagai aplikasi industri.', 'price' => 'Hubungi Kami', 'image' => 'https://www.ptborneoibanjayaperkasa.com/images/klem-gala.jpg'],
        ];

        foreach ($scrapedProducts as $item) {
            Product::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'image' => $item['image'],
                ]
            );
        }
    }
}
