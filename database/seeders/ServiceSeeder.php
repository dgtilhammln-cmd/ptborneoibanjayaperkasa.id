<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Jasa Bubut',
                'slug' => 'jasa-bubut',
                'description' => '<p>Layanan bubut presisi tinggi untuk berbagai komponen logam dengan akurasi dan kualitas terjamin sesuai kebutuhan industri Anda. Kami melayani pembuatan komponen mesin, sparepart industri, dan custom machining dengan teknologi terkini dan pengalaman bertahun-tahun.</p>
                <p>Dengan mesin bubut modern dan tenaga ahli berpengalaman, kami dapat memproduksi komponen logam dengan presisi tinggi sesuai spesifikasi yang Anda butuhkan. Mulai dari komponen kecil hingga komponen besar, kami siap melayani kebutuhan industri Anda.</p>
                <ul>
                    <li>Presisi tinggi dengan toleransi ketat</li>
                    <li>Berbagai material: Besi, Stainless Steel, Aluminium, dll</li>
                    <li>Custom machining sesuai spesifikasi</li>
                    <li>Kontrol kualitas yang ketat</li>
                    <li>Ketepatan waktu pengiriman</li>
                </ul>',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.1.svg',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.1.png',
                'meta_title' => 'Jasa Bubut Presisi - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Layanan bubut presisi tinggi untuk komponen logam dengan akurasi dan kualitas terjamin. Melayani kebutuhan industri dengan teknologi terkini.'
            ],
            [
                'name' => 'Jasa Stamping',
                'slug' => 'jasa-stamping',
                'description' => '<p>Layanan stamping untuk produksi komponen logam dengan presisi tinggi, cocok untuk kebutuhan otomotif dan industri. Kami melayani potong, plong, tekuk, dan tiruskan pipa sesuai spesifikasi Anda dengan hasil yang rapi dan presisi.</p>
                <p>Dengan mesin stamping modern, kami dapat memproduksi berbagai komponen logam dalam jumlah besar dengan kualitas konsisten. Layanan kami mencakup berbagai proses metalworking untuk memenuhi kebutuhan produksi Anda.</p>
                <ul>
                    <li>Stamping presisi tinggi</li>
                    <li>Potong, plong, tekuk, dan tiruskan pipa</li>
                    <li>Cocok untuk kebutuhan otomotif dan industri</li>
                    <li>Produksi dalam jumlah besar</li>
                    <li>Kualitas konsisten dan terjamin</li>
                </ul>',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.2.svg',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.2.png',
                'meta_title' => 'Jasa Stamping & Plong - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Layanan stamping dan plong profesional untuk produksi komponen logam dengan presisi tinggi. Cocok untuk kebutuhan otomotif dan industri.'
            ],
            [
                'name' => 'Jasa Moulding',
                'slug' => 'jasa-moulding',
                'description' => '<p>Layanan moulding untuk pembuatan komponen dengan berbagai bentuk dan ukuran sesuai spesifikasi yang dibutuhkan. Kami mengkhususkan diri dalam produksi moulding dan sparepart industri dengan standar kualitas tinggi.</p>
                <p>Dengan teknologi moulding terkini, kami dapat memproduksi komponen dengan berbagai bentuk kompleks sesuai kebutuhan Anda. Dari moulding sederhana hingga moulding dengan detail rumit, kami siap membantu mewujudkan produk Anda.</p>
                <ul>
                    <li>Berbagai bentuk dan ukuran</li>
                    <li>Moulding dengan detail rumit</li>
                    <li>Standar kualitas tinggi</li>
                    <li>Produksi sparepart industri</li>
                    <li>Konsultasi desain dan produksi</li>
                </ul>',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.3.svg',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.3.png',
                'meta_title' => 'Jasa Moulding - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Layanan moulding profesional untuk pembuatan komponen dengan berbagai bentuk dan ukuran. Standar kualitas tinggi untuk kebutuhan industri.'
            ],
            [
                'name' => 'Produksi Sparepart',
                'slug' => 'produksi-sparepart',
                'description' => '<p>Produksi sparepart berkualitas tinggi untuk berbagai kebutuhan, termasuk pedal rem, bracket, dan komponen otomotif lainnya. Kami menyediakan aksesori dan suku cadang untuk kebutuhan industri dan otomotif dengan jaminan kualitas dan ketepatan waktu pengiriman.</p>
                <p>Dengan pengalaman lebih dari 20 tahun, kami telah memproduksi berbagai jenis sparepart untuk berbagai aplikasi. Dari komponen otomotif hingga komponen industri, kami memastikan setiap produk yang kami hasilkan memenuhi standar kualitas tertinggi.</p>
                <ul>
                    <li>Pedal rem dan komponen rem</li>
                    <li>Bracket dan mounting</li>
                    <li>Komponen otomotif</li>
                    <li>Aksesori dan suku cadang</li>
                    <li>Kualitas premium dengan garansi</li>
                </ul>',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.1.svg',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.4.png',
                'meta_title' => 'Produksi Sparepart - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Produksi sparepart berkualitas tinggi untuk kebutuhan industri dan otomotif. Pedal rem, bracket, dan komponen otomotif dengan kualitas premium.'
            ]
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}

