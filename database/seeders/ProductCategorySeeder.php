<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Komponen Otomotif',
                'slug' => 'automotive',
                'description' => 'Sparepart dan komponen otomotif dengan presisi tinggi untuk berbagai jenis kendaraan',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Bracket & Mounting',
                'slug' => 'bracket',
                'description' => 'Sistem bracket dan mounting yang kuat dan tahan lama untuk berbagai aplikasi industri',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Suku Cadang',
                'slug' => 'sparepart',
                'description' => 'Suku cadang mesin industri dengan kualitas terjamin untuk performa optimal',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Aksesori Industri',
                'slug' => 'accessory',
                'description' => 'Berbagai aksesori industri dengan desain fungsional untuk meningkatkan efisiensi',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Custom Parts',
                'slug' => 'custom',
                'description' => 'Komponen custom sesuai spesifikasi dengan presisi tinggi untuk kebutuhan khusus',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Moulding Parts',
                'slug' => 'moulding',
                'description' => 'Produk moulding dan injection dengan kualitas tinggi untuk berbagai aplikasi industri',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            ProductCategory::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }

        $this->command->info('6 kategori produk berhasil ditambahkan ke database!');
    }
}
