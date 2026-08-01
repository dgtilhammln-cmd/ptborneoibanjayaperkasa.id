<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeSection;
use App\Models\HomeSectionItem;

class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        // Banner Slider Section
        $bannerSlider = HomeSection::updateOrCreate(
            ['key' => 'banner_slider'],
            [
                'title' => 'Banner / Hero Slider',
                'heading' => '',
                'subtitle' => '',
                'is_active' => true,
                'order' => 1,
                'extra_data' => [
                    'slides' => [
                        [
                            'background_image' => 'assets/img/barfi/Landscaping/banner/banner-thumb-bg-5.1.png',
                            'rating' => '5.0',
                            'rating_text' => '(Terpercaya)',
                            'title' => 'Jasa Bubut Presisi untuk Kebutuhan Industri Anda',
                            'description' => 'Layanan bubut berkualitas tinggi dengan teknologi terkini. Kami melayani pembuatan komponen mesin, sparepart industri, dan custom machining sesuai kebutuhan spesifik Anda dengan presisi tinggi dan ketepatan waktu.',
                            'button1_text' => 'Lihat Layanan Kami',
                            'button1_link' => '/services',
                            'button2_text' => 'Request Penawaran',
                            'button2_type' => 'modal',
                            'button2_link' => '',
                            'trust_text' => 'Terpercaya dengan pengalaman sejak 2003',
                            'trust_image' => 'assets/img/barfi/Landscaping/banner/vl-banner-auth5.png'
                        ],
                        [
                            'background_image' => 'assets/img/barfi/Landscaping/banner/banner-thumb-bg-5.2.png',
                            'rating' => '5.0',
                            'rating_text' => '(Terpercaya)',
                            'title' => 'Jasa Stamping & Plong Profesional',
                            'description' => 'Layanan stamping dan plong dengan mesin modern untuk berbagai kebutuhan industri. Kami melayani potong, plong, tekuk, dan tiruskan pipa sesuai spesifikasi Anda dengan hasil yang rapi dan presisi.',
                            'button1_text' => 'Lihat Layanan Kami',
                            'button1_link' => '/services',
                            'button2_text' => 'Request Penawaran',
                            'button2_type' => 'modal',
                            'button2_link' => '',
                            'trust_text' => 'Terpercaya dengan pengalaman sejak 2003',
                            'trust_image' => 'assets/img/barfi/Landscaping/banner/vl-banner-auth5.png'
                        ],
                        [
                            'background_image' => 'assets/img/barfi/Landscaping/banner/banner-thumb-bg-5.3.png',
                            'rating' => '5.0',
                            'rating_text' => '(Terpercaya)',
                            'title' => 'Moulding & Sparepart Industri Berkualitas',
                            'description' => 'Produksi moulding dan sparepart industri dengan standar kualitas tinggi. Kami menyediakan aksesori dan suku cadang untuk kebutuhan industri dan otomotif dengan jaminan kualitas dan ketepatan waktu pengiriman.',
                            'button1_text' => 'Lihat Produk Kami',
                            'button1_link' => '/products',
                            'button2_text' => 'Request Penawaran',
                            'button2_type' => 'modal',
                            'button2_link' => '',
                            'trust_text' => 'Terpercaya dengan pengalaman sejak 2003',
                            'trust_image' => 'assets/img/barfi/Landscaping/banner/vl-banner-auth5.png'
                        ],
                        [
                            'background_image' => 'assets/img/barfi/Landscaping/banner/banner-thumb-bg-5.3.png',
                            'rating' => '5.0',
                            'rating_text' => '(Terpercaya)',
                            'title' => 'Solusi Lengkap untuk Kebutuhan Industri Anda',
                            'description' => 'Dari jasa bubut, stamping, moulding hingga sparepart berkualitas tinggi. Kami melayani kontraktor industri, perdagangan, dan jasa dengan komitmen kualitas, ketepatan waktu, dan pelayanan terbaik.',
                            'button1_text' => 'Pelajari Lebih Lanjut',
                            'button1_link' => '/about',
                            'button2_text' => 'Request Penawaran',
                            'button2_type' => 'modal',
                            'button2_link' => '',
                            'trust_text' => 'Terpercaya dengan pengalaman sejak 2003',
                            'trust_image' => 'assets/img/barfi/Landscaping/banner/vl-banner-auth5.png'
                        ]
                    ]
                ]
            ]
        );

        // About Section
        $about = HomeSection::updateOrCreate(
            ['key' => 'about'],
            [
                'title' => 'Tentang Kami',
                'heading' => 'Solusi Terpercaya untuk Kebutuhan Jasa Logam & Produksi Sparepart',
                'subtitle' => 'PT. Borneo Iban Jaya Perkasa adalah perusahaan yang bergerak di bidang jasa logam, plong, dan produksi aksesori serta suku cadang berkualitas tinggi. Dengan pengalaman sejak 2003, kami melayani kebutuhan industri dan otomotif dengan komitmen terhadap kualitas dan kepuasan pelanggan.',
                'image' => 'assets/img/barfi/Landscaping/about/vl-about-5.1.png',
                'image_2' => 'assets/img/barfi/Landscaping/about/vl-about-5.2.png',
                'is_active' => true,
                'order' => 2,
                'extra_data' => [
                    'button_text' => 'Pelajari Lebih Lanjut',
                    'button_link' => '/about'
                ]
            ]
        );

        // Services Section
        $services = HomeSection::updateOrCreate(
            ['key' => 'services'],
            [
                'title' => 'Layanan Kami',
                'heading' => 'Layanan Profesional untuk Kebutuhan Industri Anda',
                'subtitle' => '',
                'is_active' => true,
                'order' => 3
            ]
        );

        // Services Items
        $servicesItems = [
            [
                'type' => 'service',
                'title' => 'Jasa Bubut',
                'description' => 'Layanan bubut presisi tinggi untuk berbagai komponen logam dengan akurasi dan kualitas terjamin sesuai kebutuhan industri Anda.',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.1.png',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.1.svg',
                'link' => '/services',
                'link_text' => 'Selengkapnya',
                'is_active' => true,
                'order' => 1
            ],
            [
                'type' => 'service',
                'title' => 'Jasa Stamping',
                'description' => 'Layanan stamping untuk produksi komponen logam dengan presisi tinggi, cocok untuk kebutuhan otomotif dan industri.',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.2.png',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.2.svg',
                'link' => '/services',
                'link_text' => 'Selengkapnya',
                'is_active' => true,
                'order' => 2
            ],
            [
                'type' => 'service',
                'title' => 'Jasa Moulding',
                'description' => 'Layanan moulding untuk pembuatan komponen dengan berbagai bentuk dan ukuran sesuai spesifikasi yang dibutuhkan.',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.3.png',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.3.svg',
                'link' => '/services',
                'link_text' => 'Selengkapnya',
                'is_active' => true,
                'order' => 3
            ],
            [
                'type' => 'service',
                'title' => 'Produksi Sparepart',
                'description' => 'Produksi sparepart berkualitas tinggi untuk berbagai kebutuhan, termasuk pedal rem, bracket, dan komponen otomotif lainnya.',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.4.png',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.1.svg',
                'link' => '/services',
                'link_text' => 'Selengkapnya',
                'is_active' => true,
                'order' => 4
            ]
        ];

        foreach ($servicesItems as $item) {
            HomeSectionItem::updateOrCreate(
                [
                    'home_section_id' => $services->id,
                    'title' => $item['title']
                ],
                $item
            );
        }

        // Products Section
        $products = HomeSection::updateOrCreate(
            ['key' => 'products'],
            [
                'title' => 'Produk Kami',
                'heading' => 'Produk Berkualitas untuk Kebutuhan Anda',
                'subtitle' => '',
                'is_active' => true,
                'order' => 4
            ]
        );

        // Products Items
        $productsItems = [
            [
                'type' => 'product',
                'title' => 'Pedal Rem Belakang',
                'description' => 'Pedal rem belakang berkualitas tinggi untuk berbagai model sepeda motor dengan desain yang sesuai dan tahan lama.',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.1.png',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.1.svg',
                'link' => '/products',
                'link_text' => 'Lihat Detail',
                'extra_data' => [
                    'price' => 'Rp 150.000',
                    'category' => 'automotive'
                ],
                'is_active' => true,
                'order' => 1
            ],
            [
                'type' => 'product',
                'title' => 'Bracket TV LED',
                'description' => 'Bracket TV LED yang didesain untuk mendukung pemasangan TV LED dengan kokoh dan aman. Terbuat dari material berkualitas tinggi.',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.2.png',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.2.svg',
                'link' => '/products',
                'link_text' => 'Lihat Detail',
                'extra_data' => [
                    'price' => 'Rp 250.000',
                    'category' => 'bracket'
                ],
                'is_active' => true,
                'order' => 2
            ],
            [
                'type' => 'product',
                'title' => 'Bracket AC / Pangkon AC',
                'description' => 'Bracket AC atau Pangkon AC berkualitas tinggi untuk instalasi AC. Tersedia dalam berbagai ukuran sesuai kebutuhan.',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.3.png',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.3.svg',
                'link' => '/products',
                'link_text' => 'Lihat Detail',
                'extra_data' => [
                    'price' => 'Rp 180.000',
                    'category' => 'bracket'
                ],
                'is_active' => true,
                'order' => 3
            ],
            [
                'type' => 'product',
                'title' => 'T-Handle Tojok',
                'description' => 'T-Handle Tojok berkualitas tinggi untuk berbagai aplikasi industri dan otomotif dengan desain ergonomis dan tahan lama.',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.4.png',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.1.svg',
                'link' => '/products',
                'link_text' => 'Lihat Detail',
                'extra_data' => [
                    'price' => 'Rp 95.000',
                    'category' => 'accessory'
                ],
                'is_active' => true,
                'order' => 4
            ],
            [
                'type' => 'product',
                'title' => 'Klem Gala',
                'description' => 'Klem Gala untuk berbagai aplikasi perpipaan dan instalasi dengan material berkualitas tinggi dan tahan korosi.',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.1.png',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.2.svg',
                'link' => '/products',
                'link_text' => 'Lihat Detail',
                'extra_data' => [
                    'price' => 'Rp 75.000',
                    'category' => 'accessory'
                ],
                'is_active' => true,
                'order' => 5
            ],
            [
                'type' => 'product',
                'title' => 'Bracket Kulkas',
                'description' => 'Bracket kulkas untuk instalasi yang aman dan kokoh. Tersedia dalam berbagai ukuran sesuai kebutuhan rumah tangga dan komersial.',
                'image' => 'assets/img/barfi/Landscaping/service/vl-service-5.2.png',
                'icon' => 'assets/img/barfi/icon/vl-service-icon-5.3.svg',
                'link' => '/products',
                'link_text' => 'Lihat Detail',
                'extra_data' => [
                    'price' => 'Rp 200.000',
                    'category' => 'bracket'
                ],
                'is_active' => true,
                'order' => 6
            ]
        ];

        foreach ($productsItems as $item) {
            HomeSectionItem::updateOrCreate(
                [
                    'home_section_id' => $products->id,
                    'title' => $item['title']
                ],
                $item
            );
        }

        // Projects Section
        $projects = HomeSection::updateOrCreate(
            ['key' => 'projects'],
            [
                'title' => '',
                'heading' => '',
                'subtitle' => '',
                'is_active' => true,
                'order' => 5
            ]
        );

        // Projects Items
        $projectsItems = [
            [
                'type' => 'project',
                'title' => 'Komponen Industri',
                'description' => '',
                'image' => 'assets/img/barfi/Landscaping/project/vl-project-thumb-5.1.png',
                'link' => '/services',
                'extra_data' => [
                    'category' => 'Jasa Bubut'
                ],
                'is_active' => true,
                'order' => 1
            ],
            [
                'type' => 'project',
                'title' => 'Komponen Industri',
                'description' => '',
                'image' => 'assets/img/barfi/Landscaping/project/vl-project-thumb-5.2.png',
                'link' => '/services',
                'extra_data' => [
                    'category' => 'Jasa Bubut'
                ],
                'is_active' => true,
                'order' => 2
            ],
            [
                'type' => 'project',
                'title' => 'Komponen Industri',
                'description' => '',
                'image' => 'assets/img/barfi/Landscaping/project/vl-project-thumb-5.3.png',
                'link' => '/services',
                'extra_data' => [
                    'category' => 'Jasa Bubut'
                ],
                'is_active' => true,
                'order' => 3
            ],
            [
                'type' => 'project',
                'title' => 'Komponen Industri',
                'description' => '',
                'image' => 'assets/img/barfi/Landscaping/project/vl-project-thumb-5.4.png',
                'link' => '/services',
                'extra_data' => [
                    'category' => 'Jasa Bubut'
                ],
                'is_active' => true,
                'order' => 4
            ],
            [
                'type' => 'project',
                'title' => 'Komponen Industri',
                'description' => '',
                'image' => 'assets/img/barfi/Landscaping/project/vl-project-thumb-5.5.png',
                'link' => '/services',
                'extra_data' => [
                    'category' => 'Jasa Bubut'
                ],
                'is_active' => true,
                'order' => 5
            ],
            [
                'type' => 'project',
                'title' => 'Komponen Industri',
                'description' => '',
                'image' => 'assets/img/barfi/Landscaping/project/vl-project-thumb-5.6.png',
                'link' => '/services',
                'extra_data' => [
                    'category' => 'Jasa Bubut'
                ],
                'is_active' => true,
                'order' => 6
            ],
            [
                'type' => 'project',
                'title' => 'Komponen Industri',
                'description' => '',
                'image' => 'assets/img/barfi/Landscaping/project/vl-project-thumb-5.7.png',
                'link' => '/services',
                'extra_data' => [
                    'category' => 'Jasa Bubut'
                ],
                'is_active' => true,
                'order' => 7
            ],
            [
                'type' => 'project',
                'title' => 'Komponen Industri',
                'description' => '',
                'image' => 'assets/img/barfi/Landscaping/project/vl-project-thumb-5.8.png',
                'link' => '/services',
                'extra_data' => [
                    'category' => 'Jasa Bubut'
                ],
                'is_active' => true,
                'order' => 8
            ]
        ];

        foreach ($projectsItems as $item) {
            HomeSectionItem::updateOrCreate(
                [
                    'home_section_id' => $projects->id,
                    'title' => $item['title']
                ],
                $item
            );
        }

        // Work Process Section
        $workProcess = HomeSection::updateOrCreate(
            ['key' => 'work_process'],
            [
                'title' => 'Cara Kami Bekerja',
                'heading' => 'Proses Produksi yang Terpercaya, Langkah demi Langkah',
                'subtitle' => '',
                'is_active' => true,
                'order' => 6,
                'extra_data' => [
                    'tag_cloud' => 'Bubut, Stamping, Moulding, Sparepart, Presisi, Kualitas, Industri, Otomotif, Logam, Plong, Tekuk, Potong, Bracket, Pedal Rem, Aksesori'
                ]
            ]
        );

        // Work Process Items (Steps)
        $workProcessItems = [
            [
                'type' => 'work_step',
                'title' => 'Konsultasi & Perencanaan',
                'description' => 'Mendiskusikan kebutuhan Anda dan membuat rencana produksi yang sesuai dengan spesifikasi yang diinginkan.',
                'extra_data' => [
                    'step_number' => 1
                ],
                'is_active' => true,
                'order' => 1
            ],
            [
                'type' => 'work_step',
                'title' => 'Desain & Persiapan',
                'description' => 'Tim kami merancang dan mempersiapkan proses produksi sesuai kebutuhan, dengan peralatan yang terkalibrasi untuk hasil presisi tinggi.',
                'extra_data' => [
                    'step_number' => 2
                ],
                'is_active' => true,
                'order' => 2
            ],
            [
                'type' => 'work_step',
                'title' => 'Implementasi & Produksi',
                'description' => 'Tim berpengalaman kami menjalankan proses produksi dengan presisi tinggi, menggunakan teknologi terkini untuk hasil berkualitas.',
                'extra_data' => [
                    'step_number' => 3
                ],
                'is_active' => true,
                'order' => 3
            ],
            [
                'type' => 'work_step',
                'title' => 'Quality Control & Dukungan',
                'description' => 'Kami melakukan quality control ketat dan memberikan dukungan purna jual untuk memastikan produk sesuai standar kualitas.',
                'extra_data' => [
                    'step_number' => 4
                ],
                'is_active' => true,
                'order' => 4
            ]
        ];

        foreach ($workProcessItems as $item) {
            HomeSectionItem::updateOrCreate(
                [
                    'home_section_id' => $workProcess->id,
                    'title' => $item['title']
                ],
                $item
            );
        }

        // Why Choose Us Section
        $whyChooseUs = HomeSection::updateOrCreate(
            ['key' => 'why_choose_us'],
            [
                'title' => 'Mengapa Pilih Kami',
                'heading' => 'Kualitas & Kepercayaan, Setiap Proyek, Setiap Detail',
                'subtitle' => 'Memilih PT. Borneo Iban Jaya Perkasa berarti memilih tim yang peduli dengan kebutuhan industri Anda. Kami menggabungkan pengalaman, presisi, dan keandalan untuk memberikan produk dan jasa berkualitas tinggi yang memenuhi standar industri.',
                'image' => 'assets/img/barfi/Landscaping/choose/vl-choose-thumb-5.1.png',
                'is_active' => true,
                'order' => 7
            ]
        );

        // Why Choose Us Items (Features)
        $whyChooseUsItems = [
            [
                'type' => 'feature',
                'title' => 'Pengalaman Sejak 2003',
                'description' => 'Dengan pengalaman lebih dari 20 tahun, kami telah melayani berbagai kebutuhan industri dan otomotif dengan komitmen terhadap kualitas dan kepuasan pelanggan.',
                'icon' => 'assets/img/barfi/icon/vl-choose-icon-5.1.svg',
                'is_active' => true,
                'order' => 1
            ],
            [
                'type' => 'feature',
                'title' => 'Kualitas Terjamin. Presisi Tinggi.',
                'description' => 'Layanan jasa bubut, stamping, moulding, dan produksi sparepart kami dibangun dengan standar kualitas tinggi dan presisi yang akurat untuk memenuhi kebutuhan industri Anda.',
                'icon' => 'assets/img/barfi/icon/vl-choose-icon-5.2.svg',
                'is_active' => true,
                'order' => 2
            ]
        ];

        foreach ($whyChooseUsItems as $item) {
            HomeSectionItem::updateOrCreate(
                [
                    'home_section_id' => $whyChooseUs->id,
                    'title' => $item['title']
                ],
                $item
            );
        }

        // Testimonials Section
        $testimonials = HomeSection::updateOrCreate(
            ['key' => 'testimonials'],
            [
                'title' => 'Testimoni',
                'heading' => 'Apa Kata Klien Kami',
                'subtitle' => '',
                'is_active' => true,
                'order' => 8
            ]
        );

        // Testimonials Items
        $testimonialsItems = [
            [
                'type' => 'testimonial',
                'title' => '',
                'description' => '"Kualitas produk dan layanan jasa bubut mereka sangat memuaskan. Hasilnya presisi dan sesuai dengan spesifikasi yang kami butuhkan untuk kebutuhan industri."',
                'image' => 'assets/img/barfi/Landscaping/testimonial/testimonial-auth-thumb-5.1.png',
                'link' => '/testimonials',
                'extra_data' => [
                    'author_name' => 'Budi Santoso',
                    'author_position' => 'Manager Produksi',
                    'rating' => 5
                ],
                'is_active' => true,
                'order' => 1
            ],
            [
                'type' => 'testimonial',
                'title' => '',
                'description' => '"Pelayanan sangat profesional dan tepat waktu. Produk sparepart yang kami pesan berkualitas tinggi dan sesuai dengan kebutuhan otomotif kami."',
                'image' => 'assets/img/barfi/Landscaping/testimonial/testimonial-auth-thumb-5.2.png',
                'link' => '/testimonials',
                'extra_data' => [
                    'author_name' => 'Siti Nurhaliza',
                    'author_position' => 'Owner Bengkel',
                    'rating' => 5
                ],
                'is_active' => true,
                'order' => 2
            ],
            [
                'type' => 'testimonial',
                'title' => '',
                'description' => '"Layanan jasa stamping dan moulding mereka sangat handal. Timnya responsif dan hasil produksinya selalu sesuai dengan standar kualitas yang kami harapkan."',
                'image' => 'assets/img/barfi/Landscaping/testimonial/testimonial-auth-thumb-5.3.png',
                'link' => '/testimonials',
                'extra_data' => [
                    'author_name' => 'Ahmad Fauzi',
                    'author_position' => 'Direktur PT',
                    'rating' => 5
                ],
                'is_active' => true,
                'order' => 3
            ],
            [
                'type' => 'testimonial',
                'title' => '',
                'description' => '"Pelayanan sangat profesional dan tepat waktu. Produk sparepart yang kami pesan berkualitas tinggi dan sesuai dengan kebutuhan otomotif kami."',
                'image' => 'assets/img/barfi/Landscaping/testimonial/testimonial-auth-thumb-5.2.png',
                'link' => '/testimonials',
                'extra_data' => [
                    'author_name' => 'Siti Nurhaliza',
                    'author_position' => 'Owner Bengkel',
                    'rating' => 5
                ],
                'is_active' => true,
                'order' => 4
            ]
        ];

        foreach ($testimonialsItems as $item) {
            HomeSectionItem::updateOrCreate(
                [
                    'home_section_id' => $testimonials->id,
                    'order' => $item['order']
                ],
                $item
            );
        }

        // Blog Section
        $blog = HomeSection::updateOrCreate(
            ['key' => 'blog'],
            [
                'title' => 'Blog Kami',
                'heading' => 'Tips, Informasi & Update Terbaru dari Industri',
                'subtitle' => '',
                'is_active' => true,
                'order' => 9
            ]
        );

        $this->command->info('Home content seeded successfully!');
    }
}
