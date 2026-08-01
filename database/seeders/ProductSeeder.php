<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Komponen Otomotif (3 produk)
            [
                'name' => 'Suku Cadang Motor',
                'category' => 'automotive',
                'description' => '<p>Berbagai suku cadang motor berkualitas tinggi untuk perawatan dan perbaikan kendaraan bermotor Anda dengan presisi tinggi. Produk kami dirancang untuk ketahanan dan performa optimal.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.1.png',
                'meta_title' => 'Suku Cadang Motor - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Suku cadang motor berkualitas tinggi dengan presisi tinggi untuk perawatan dan perbaikan kendaraan bermotor Anda.',
            ],
            [
                'name' => 'Komponen Mesin Mobil',
                'category' => 'automotive',
                'description' => '<p>Sparepart dan komponen mesin mobil dengan kualitas terjamin. Cocok untuk berbagai jenis kendaraan dengan presisi tinggi dan ketahanan yang baik.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.2.png',
                'meta_title' => 'Komponen Mesin Mobil - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Sparepart dan komponen mesin mobil dengan kualitas terjamin untuk berbagai jenis kendaraan.',
            ],
            [
                'name' => 'Aksesori Kendaraan',
                'category' => 'automotive',
                'description' => '<p>Aksesori kendaraan dengan desain fungsional dan tahan lama untuk meningkatkan performa dan estetika kendaraan Anda. Didesain dengan standar kualitas tinggi.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.3.png',
                'meta_title' => 'Aksesori Kendaraan - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Aksesori kendaraan dengan desain fungsional dan tahan lama untuk meningkatkan performa kendaraan Anda.',
            ],

            // Bracket & Mounting (3 produk)
            [
                'name' => 'Bracket Baja',
                'category' => 'bracket',
                'description' => '<p>Bracket baja dengan kekuatan tinggi untuk berbagai aplikasi mounting industri. Didesain untuk beban berat dan kondisi ekstrem dengan ketahanan yang optimal.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.4.png',
                'meta_title' => 'Bracket Baja - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Bracket baja dengan kekuatan tinggi untuk berbagai aplikasi mounting industri dengan ketahanan optimal.',
            ],
            [
                'name' => 'Mounting System',
                'category' => 'bracket',
                'description' => '<p>Sistem mounting yang kuat dan tahan lama untuk berbagai peralatan industri. Dapat disesuaikan dengan kebutuhan spesifik Anda untuk hasil yang optimal.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.5.png',
                'meta_title' => 'Mounting System - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Sistem mounting yang kuat dan tahan lama untuk berbagai peralatan industri dengan kualitas terjamin.',
            ],
            [
                'name' => 'Bracket Custom',
                'category' => 'bracket',
                'description' => '<p>Bracket custom sesuai spesifikasi Anda. Kami melayani pembuatan bracket dengan ukuran dan bentuk sesuai kebutuhan proyek dengan presisi tinggi.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.6.png',
                'meta_title' => 'Bracket Custom - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Bracket custom sesuai spesifikasi Anda dengan ukuran dan bentuk sesuai kebutuhan proyek.',
            ],

            // Suku Cadang (3 produk)
            [
                'name' => 'Suku Cadang Mesin Industri',
                'category' => 'sparepart',
                'description' => '<p>Suku cadang mesin industri dengan kualitas terjamin. Dapat disesuaikan dengan spesifikasi mesin Anda untuk performa optimal dan ketahanan yang baik.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.1.png',
                'meta_title' => 'Suku Cadang Mesin Industri - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Suku cadang mesin industri dengan kualitas terjamin untuk performa optimal mesin Anda.',
            ],
            [
                'name' => 'Komponen Mesin CNC',
                'category' => 'sparepart',
                'description' => '<p>Komponen dan sparepart untuk mesin CNC dengan presisi tinggi. Cocok untuk berbagai jenis mesin CNC dengan kualitas terjamin dan akurasi tinggi.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.2.png',
                'meta_title' => 'Komponen Mesin CNC - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Komponen dan sparepart untuk mesin CNC dengan presisi tinggi untuk berbagai jenis mesin CNC.',
            ],
            [
                'name' => 'Sparepart Mesin Bubut',
                'category' => 'sparepart',
                'description' => '<p>Suku cadang untuk mesin bubut dengan kualitas tinggi. Didesain untuk ketahanan dan performa optimal dalam operasional produksi dengan presisi tinggi.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.3.png',
                'meta_title' => 'Sparepart Mesin Bubut - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Suku cadang untuk mesin bubut dengan kualitas tinggi untuk ketahanan dan performa optimal.',
            ],

            // Aksesori Industri (3 produk)
            [
                'name' => 'T-Handle Tojok',
                'category' => 'accessory',
                'description' => '<p>T-Handle Tojok berkualitas tinggi untuk berbagai aplikasi industri dan otomotif dengan desain ergonomis dan tahan lama. Cocok untuk kebutuhan produksi yang beragam.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.4.png',
                'meta_title' => 'T-Handle Tojok - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'T-Handle Tojok berkualitas tinggi untuk berbagai aplikasi industri dan otomotif dengan desain ergonomis.',
            ],
            [
                'name' => 'Aksesori Mesin',
                'category' => 'accessory',
                'description' => '<p>Berbagai aksesori mesin dengan desain fungsional untuk meningkatkan efisiensi dan produktivitas operasional pabrik Anda. Didesain dengan standar kualitas tinggi.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.5.png',
                'meta_title' => 'Aksesori Mesin - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Berbagai aksesori mesin dengan desain fungsional untuk meningkatkan efisiensi operasional pabrik.',
            ],
            [
                'name' => 'Komponen Industri',
                'category' => 'accessory',
                'description' => '<p>Suku cadang dan komponen untuk berbagai aplikasi industri dengan kualitas tinggi dan sesuai standar industri. Cocok untuk berbagai kebutuhan produksi.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.6.png',
                'meta_title' => 'Komponen Industri - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Suku cadang dan komponen untuk berbagai aplikasi industri dengan kualitas tinggi sesuai standar.',
            ],

            // Custom Parts (3 produk)
            [
                'name' => 'Custom Machining Parts',
                'category' => 'custom',
                'description' => '<p>Komponen custom sesuai spesifikasi Anda. Kami melayani pembuatan komponen dengan presisi tinggi sesuai kebutuhan khusus proyek Anda dengan kualitas terjamin.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.1.png',
                'meta_title' => 'Custom Machining Parts - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Komponen custom sesuai spesifikasi Anda dengan presisi tinggi untuk kebutuhan khusus proyek.',
            ],
            [
                'name' => 'Custom Bubut Parts',
                'category' => 'custom',
                'description' => '<p>Komponen hasil bubut custom dengan presisi tinggi sesuai spesifikasi Anda. Cocok untuk kebutuhan khusus yang memerlukan akurasi tinggi dan kualitas terjamin.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.2.png',
                'meta_title' => 'Custom Bubut Parts - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Komponen hasil bubut custom dengan presisi tinggi untuk kebutuhan khusus yang memerlukan akurasi tinggi.',
            ],
            [
                'name' => 'Custom Stamping Parts',
                'category' => 'custom',
                'description' => '<p>Komponen hasil stamping custom dengan bentuk dan ukuran sesuai kebutuhan Anda. Dapat diproduksi dalam berbagai material dengan kualitas terjamin.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.3.png',
                'meta_title' => 'Custom Stamping Parts - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Komponen hasil stamping custom dengan bentuk dan ukuran sesuai kebutuhan Anda dalam berbagai material.',
            ],

            // Moulding Parts (3 produk)
            [
                'name' => 'Moulding & Injection Parts',
                'category' => 'moulding',
                'description' => '<p>Produk moulding dan injection dengan kualitas tinggi. Cocok untuk berbagai aplikasi industri dengan bentuk dan ukuran yang dapat disesuaikan sesuai kebutuhan Anda.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.4.png',
                'meta_title' => 'Moulding & Injection Parts - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Produk moulding dan injection dengan kualitas tinggi untuk berbagai aplikasi industri.',
            ],
            [
                'name' => 'Plastic Moulding',
                'category' => 'moulding',
                'description' => '<p>Produk plastic moulding dengan kualitas tinggi untuk berbagai aplikasi. Dapat diproduksi dalam berbagai bentuk dan ukuran sesuai kebutuhan dengan standar kualitas tinggi.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.5.png',
                'meta_title' => 'Plastic Moulding - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Produk plastic moulding dengan kualitas tinggi untuk berbagai aplikasi dalam berbagai bentuk dan ukuran.',
            ],
            [
                'name' => 'Injection Moulding',
                'category' => 'moulding',
                'description' => '<p>Produk injection moulding dengan presisi tinggi untuk berbagai kebutuhan industri. Cocok untuk produksi massal dengan kualitas konsisten dan ketahanan yang baik.</p>',
                'price' => null,
                'image' => 'assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.6.png',
                'meta_title' => 'Injection Moulding - PT. Borneo Iban Jaya Perkasa',
                'meta_description' => 'Produk injection moulding dengan presisi tinggi untuk produksi massal dengan kualitas konsisten.',
            ],
        ];

        foreach ($products as $productData) {
            $productData['slug'] = Str::slug($productData['name']);
            Product::updateOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );
        }

        $this->command->info('18 produk berhasil ditambahkan ke database!');
    }
}
