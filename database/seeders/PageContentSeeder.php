<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // About Page
        Page::updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'Tentang Kami',
                'meta_title' => 'Tentang Kami - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'PT. Borneo Iban Jaya Perkasa adalah perusahaan jasa logam, bubut, stamping, moulding, dan produksi sparepart berkualitas tinggi sejak 2003. Berpengalaman lebih dari 22 tahun melayani kebutuhan industri dan otomotif.',
                'is_published' => true,
                'sections' => [
                    'breadcrumb' => [
                        'title' => 'Tentang Kami',
                        'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg',
                    ],
                    'about_section' => [
                        'subtitle' => 'Tentang Kami',
                        'heading' => 'Solusi Terpercaya untuk Kebutuhan Jasa Logam & Produksi Sparepart',
                        'description' => 'PT. Borneo Iban Jaya Perkasa adalah perusahaan yang bergerak di bidang jasa logam, plong, dan produksi aksesori serta suku cadang berkualitas tinggi. Dengan pengalaman sejak 2003, kami melayani kebutuhan industri dan otomotif dengan komitmen terhadap kualitas dan kepuasan pelanggan. Berlokasi di Sidoarjo, Jawa Timur, kami menawarkan berbagai layanan termasuk jasa bubut, stamping, moulding, plong, tekuk, dan produksi sparepart sesuai kebutuhan pelanggan.',
                        'image_1' => 'assets/img/barfi/SnowRemovalTwo/about/vl-about2.1.png',
                        'image_2' => 'assets/img/barfi/SnowRemovalTwo/about/vl-about2.2.png',
                        'counter_1_number' => '22+',
                        'counter_1_text' => 'Tahun Pengalaman melayani kebutuhan industri dan otomotif dengan kualitas terpercaya sejak 2003.',
                        'counter_2_number' => '1000+',
                        'counter_2_text' => 'Proyek Selesai dengan kepuasan pelanggan yang tinggi dan kualitas konsisten.',
                    ],
                    'fact_section' => [
                        'subtitle' => 'Fakta Menarik',
                        'facts' => [
                            ['number' => '1000', 'symbol' => '+', 'text' => 'Proyek Selesai'],
                            ['number' => '500', 'symbol' => '+', 'text' => 'Klien Puas'],
                            ['number' => '98', 'symbol' => '%', 'text' => 'Tingkat Kepuasan'],
                            ['number' => '22', 'symbol' => '+', 'text' => 'Tahun Pengalaman'],
                        ],
                    ],
                    'choose_section' => [
                        'subtitle' => 'Mengapa Memilih Kami',
                        'heading' => 'Komitmen Kami untuk Memberikan Solusi Terbaik dalam Jasa Logam dan Produksi Sparepart',
                        'description' => 'Dengan pengalaman lebih dari 22 tahun, PT. Borneo Iban Jaya Perkasa telah membangun reputasi sebagai mitra terpercaya dalam industri jasa logam dan produksi sparepart. Kami menggabungkan keahlian teknis, peralatan modern, dan komitmen terhadap kualitas untuk memberikan hasil yang presisi dan memuaskan.',
                        'image' => 'assets/img/barfi/SnowRemovalOne/choose/vl-choose-thumb-inner1.1.png',
                        'features' => [
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.1.svg', 'title' => 'Tenaga Ahli Berpengalaman', 'description' => 'Tim kami terdiri dari profesional terlatih dengan pengalaman bertahun-tahun dalam menangani berbagai kebutuhan jasa logam dan produksi sparepart industri.'],
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.2.svg', 'title' => 'Peralatan Modern & Teknologi Terkini', 'description' => 'Kami menggunakan mesin dan peralatan modern dengan teknologi terkini untuk menghasilkan produk dengan presisi tinggi dan kualitas konsisten.'],
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.3.svg', 'title' => 'Jaminan Kepuasan Pelanggan', 'description' => 'Kami berkomitmen memberikan pelayanan terbaik dan memastikan setiap klien mendapatkan hasil yang memuaskan sesuai dengan standar kualitas tinggi.'],
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.4.svg', 'title' => 'Layanan Lengkap & Terintegrasi', 'description' => 'Dari jasa bubut, stamping, plong, moulding hingga produksi sparepart - kami menyediakan solusi lengkap untuk kebutuhan industri Anda dalam satu tempat.'],
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.5.svg', 'title' => 'Tepat Waktu & Dapat Diandalkan', 'description' => 'Kami memahami pentingnya ketepatan waktu dalam industri. Setiap proyek dikerjakan dengan efisien dan diselesaikan sesuai jadwal yang disepakati.'],
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.6.svg', 'title' => 'Terpercaya & Berpengalaman Sejak 2003', 'description' => 'Lebih dari 22 tahun melayani berbagai industri dengan integritas tinggi, kualitas terjamin, dan komitmen terhadap kepuasan pelanggan.'],
                        ],
                    ],
                    'work_section' => [
                        'subtitle' => 'Cara Kami Bekerja',
                        'heading' => 'Proses Kerja yang Terstruktur dan Profesional',
                        'steps' => [
                            ['number' => '01', 'title' => 'Konsultasi & Permintaan Penawaran', 'description' => 'Hubungi kami melalui telepon, WhatsApp, atau email. Jelaskan kebutuhan proyek Anda dan kami akan memberikan konsultasi serta penawaran yang sesuai dengan kebutuhan dan budget Anda.'],
                            ['number' => '02', 'title' => 'Analisis & Perencanaan', 'description' => 'Tim kami akan menganalisis kebutuhan Anda secara detail, merencanakan proses produksi, dan menentukan spesifikasi yang tepat untuk hasil optimal sesuai standar industri.'],
                            ['number' => '03', 'title' => 'Produksi & Quality Control', 'description' => 'Proses produksi dilakukan dengan standar kualitas tinggi, dilengkapi quality control di setiap tahap untuk memastikan hasil sesuai spesifikasi dan memenuhi standar kualitas yang ditetapkan.'],
                        ],
                    ],
                    'value_section' => [
                        'subtitle' => 'Nilai-Nilai Kami',
                        'heading' => 'Komitmen terhadap Kualitas, Ketepatan Waktu, dan Kepuasan Pelanggan',
                        'description' => 'Dengan peralatan modern, tim yang terlatih, dan komitmen terhadap keamanan serta keandalan, kami memberikan solusi jasa logam dan produksi sparepart yang efisien. Setiap proyek ditangani dengan profesionalisme tinggi untuk memastikan hasil yang memuaskan dan sesuai dengan kebutuhan industri Anda.',
                        'image' => 'assets/img/barfi/SnowRemovalOne/service/vl-value-thumb1.1.png',
                        'mission_title' => 'Misi Kami',
                        'mission_text' => 'Secara berkesinambungan menyediakan produk dan jasa yang berkualitas tinggi serta memenuhi kebutuhan pelanggan melalui program pemasaran yang terbaik. Mengembangkan karyawan yang berkompeten dengan menciptakan lingkungan kerja yang baik untuk mendukung tercapainya kepuasan pelanggan. Memperkuat kolaborasi dengan supplier dan distributor melalui komunikasi dan kerja sama yang lebih baik. Berusaha menyeimbangkan pencapaian perusahaan dalam peningkatan profit, sumber daya manusia, dan lingkungan.',
                        'vision_title' => 'Visi Kami',
                        'vision_text' => 'Menjadi perusahaan industri dan jasa yang mampu bersaing dan berkembang dengan sehat, mengutamakan pelayanan, mutu, dan reputasi global. Kami berkomitmen untuk menjadi mitra terpercaya dalam industri jasa logam dan produksi sparepart dengan integritas tinggi dan pendekatan inovatif.',
                    ],
                    'testimonial_section' => [
                        'subtitle' => 'Testimoni',
                        'heading' => 'Klien Kami Puas dengan Hasil yang Kami Berikan',
                        'testimonials' => [
                            ['quote' => 'PT. Borneo Iban Jaya Perkasa telah menjadi mitra terpercaya kami selama 5 tahun. Kualitas produk sparepart yang mereka hasilkan sangat konsisten dan presisi. Tim mereka responsif dan profesional dalam menangani setiap permintaan.', 'author' => 'Budi Santoso', 'position' => 'Direktur PT. Industri Otomotif', 'image' => 'assets/img/barfi/SnowRemovalOne/testimonial/testimonial1.1.png'],
                            ['quote' => 'Jasa bubut dan stamping dari PT. Borneo Iban Jaya Perkasa sangat memuaskan. Mereka selalu tepat waktu dan hasilnya sesuai dengan spesifikasi yang kami minta. Sangat direkomendasikan untuk kebutuhan industri.', 'author' => 'Siti Nurhaliza', 'position' => 'Manager Produksi PT. Manufaktur', 'image' => 'assets/img/barfi/SnowRemovalOne/testimonial/testimonial1.2.png'],
                            ['quote' => 'Kami sangat puas dengan pelayanan jasa plong dan moulding dari PT. Borneo Iban Jaya Perkasa. Tim mereka sangat detail dan hasilnya rapi. Harga juga kompetitif dengan kualitas yang terjamin.', 'author' => 'Ahmad Rizki', 'position' => 'Owner CV. Teknik Logam', 'image' => 'assets/img/barfi/SnowRemovalOne/testimonial/testimonial1.3.png'],
                        ],
                    ],
                    'team_section' => [
                        'subtitle' => 'Tim Kami',
                        'heading' => 'Tim Profesional yang Berpengalaman di Bidang Jasa Logam',
                        'members' => [
                            ['name' => 'Ir. Budi Santoso', 'position' => 'Direktur Operasional', 'image' => 'assets/img/barfi/LawnCare/team/vl-team4.1.png'],
                            ['name' => 'Ahmad Rizki, ST', 'position' => 'Manager Produksi', 'image' => 'assets/img/barfi/LawnCare/team/vl-team4.2.png'],
                            ['name' => 'Siti Nurhaliza', 'position' => 'Quality Control Supervisor', 'image' => 'assets/img/barfi/LawnCare/team/vl-team4.3.png'],
                            ['name' => 'Dewi Lestari', 'position' => 'Customer Service Manager', 'image' => 'assets/img/barfi/LawnCare/team/vl-team4.4.png'],
                        ],
                    ],
                ],
            ]
        );

        // Services Page
        Page::updateOrCreate(
            ['slug' => 'services'],
            [
                'title' => 'Layanan Kami',
                'meta_title' => 'Layanan Kami - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'PT. Borneo Iban Jaya Perkasa menyediakan berbagai layanan jasa logam profesional: jasa bubut, stamping, moulding, plong, tekuk, dan produksi sparepart berkualitas tinggi untuk kebutuhan industri dan otomotif.',
                'is_published' => true,
                'sections' => [
                    'breadcrumb' => [
                        'title' => 'Layanan Kami',
                        'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg',
                    ],
                    'work_section' => [
                        'subtitle' => 'Cara Kami Bekerja',
                        'heading' => 'Proses Layanan Jasa Logam & Produksi Sparepart',
                        'background_image' => 'assets/img/barfi/shape/fact-shape-about-bg.svg',
                        'steps' => [
                            ['number' => '01', 'title' => 'Konsultasi & Permintaan Penawaran', 'description' => 'Hubungi kami melalui WhatsApp atau email untuk konsultasi kebutuhan Anda. Jelaskan spesifikasi, jumlah, dan detail proyek yang Anda butuhkan. Tim kami akan memberikan saran profesional dan penawaran yang kompetitif.'],
                            ['number' => '02', 'title' => 'Analisis & Perencanaan Produksi', 'description' => 'Tim ahli kami akan menganalisis kebutuhan Anda secara detail, merencanakan proses produksi, menentukan material yang tepat, dan menyusun timeline pengerjaan yang efisien sesuai standar industri.'],
                            ['number' => '03', 'title' => 'Produksi & Quality Control', 'description' => 'Proses produksi dilakukan dengan standar kualitas tinggi menggunakan peralatan modern. Setiap tahap dikontrol ketat untuk memastikan hasil sesuai spesifikasi dan memenuhi standar kualitas yang ditetapkan.'],
                            ['number' => '04', 'title' => 'Pengiriman & Follow Up', 'description' => 'Setelah produksi selesai, produk dikirim sesuai jadwal yang disepakati. Kami melakukan follow up untuk memastikan kepuasan pelanggan dan siap memberikan dukungan purna jual jika diperlukan.'],
                        ],
                    ],
                    'contact_section' => [
                        'subtitle' => 'Hubungi Kami',
                        'heading' => 'Layanan Profesional untuk Kebutuhan Industri Anda',
                        'contact_title' => 'Hubungi Kami Sekarang',
                        'contact_description' => 'Ada pertanyaan tentang layanan kami? Tim profesional kami siap membantu Anda. Hubungi kami untuk konsultasi gratis, penawaran, atau informasi lebih lanjut tentang jasa bubut, stamping, moulding, plong, tekuk, dan produksi sparepart. Kami melayani kebutuhan industri dan otomotif dengan komitmen terhadap kualitas dan kepuasan pelanggan.',
                        'contact_cards' => [
                            ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.1.svg', 'title' => 'Alamat', 'text' => 'Jl. Ngingas Selatan No. 29, RT. 002, RW. 001, Ngingas Waru, Sidoarjo, Jawa Timur 61256'],
                            ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.2.svg', 'title' => 'WhatsApp', 'text' => '031-8559-7449 / 0895-1553-2597'],
                            ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.3.svg', 'title' => 'Jam Operasional', 'text' => 'Senin - Jumat: 08:00 - 17:00 WIB'],
                            ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.4.svg', 'title' => 'Email', 'text' => 'bigjaya503@gmail.com'],
                        ],
                    ],
                ],
            ]
        );

        // Products Page
        Page::updateOrCreate(
            ['slug' => 'products'],
            [
                'title' => 'Our Products',
                'is_published' => true,
                'sections' => [
                    'breadcrumb' => [
                        'title' => 'Our Products',
                        'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg',
                    ],
                ],
            ]
        );

        // Blog Page
        Page::updateOrCreate(
            ['slug' => 'blog'],
            [
                'title' => 'Our Blog',
                'is_published' => true,
                'sections' => [
                    'breadcrumb' => [
                        'title' => 'Our Blog',
                        'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg',
                    ],
                ],
            ]
        );

        // Contact Page
        Page::updateOrCreate(
            ['slug' => 'contact'],
            [
                'title' => 'Hubungi Kami',
                'meta_title' => 'Hubungi Kami - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Hubungi PT. Borneo Iban Jaya Perkasa untuk konsultasi, penawaran, atau informasi lebih lanjut tentang jasa bubut, stamping, moulding, plong, tekuk, dan produksi sparepart. Kami siap membantu kebutuhan industri Anda.',
                'is_published' => true,
                'sections' => [
                    'breadcrumb' => [
                        'title' => 'Hubungi Kami',
                        'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg',
                    ],
                    'contact_section' => [
                        'subtitle' => 'Hubungi Kami',
                        'heading' => 'Hubungi Tim Profesional Kami untuk Solusi Jasa Logam & Produksi Sparepart',
                        'description' => 'Ada pertanyaan tentang layanan kami? Tim profesional PT. Borneo Iban Jaya Perkasa siap membantu Anda. Hubungi kami untuk konsultasi gratis, penawaran, atau informasi lebih lanjut tentang jasa bubut, stamping, moulding, plong, tekuk, dan produksi sparepart. Kami berkomitmen memberikan pelayanan terbaik untuk kebutuhan industri dan otomotif Anda.',
                        'image' => 'assets/img/barfi/SnowRemovalOne/contact/vl-contact-thumb1.png',
                        'form_title' => 'Kirim Pesan kepada Kami',
                    ],
                    'contact_cards' => [
                        [
                            'icon_type' => 'image',
                            'icon' => 'assets/img/barfi/icon/vl-contact-icon1.1.svg',
                            'title' => 'Email Address',
                            'content' => ['bigjaya503@gmail.com'],
                        ],
                        [
                            'icon_type' => 'whatsapp',
                            'icon' => 'whatsapp',
                            'title' => 'WhatsApp',
                            'content' => ['031-8559-7449', '0895-1553-2597'],
                        ],
                        [
                            'icon_type' => 'image',
                            'icon' => 'assets/img/barfi/icon/vl-contact-icon1.3.svg',
                            'title' => 'Alamat Kantor',
                            'content' => ['Jl. Ngingas Selatan No. 29, RT. 002, RW. 001', 'Ngingas Waru, Sidoarjo, Jawa Timur 61256'],
                        ],
                        [
                            'icon_type' => 'image',
                            'icon' => 'assets/img/barfi/icon/vl-contact-icon1.4.svg',
                            'title' => 'Jam Operasional',
                            'content' => ['Senin - Jumat: 08:00 - 17:00 WIB', 'Sabtu: 08:00 - 12:00 WIB'],
                        ],
                    ],
                    'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1234567890!2d112.6789012345!3d-7.3456789012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMjAnNDQuNCJTIDExMsKwNDAnNDQuMSJF!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid',
                ],
            ]
        );
    }
}
