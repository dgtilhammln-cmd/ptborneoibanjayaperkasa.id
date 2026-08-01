<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        // Data slider berdasarkan gambar yang ditunjukkan
        $defaultSliderData = [
            [
                'badge' => 'Terbaru',
                'tagline' => 'PT. Borneo Iban Jaya Perkasa',
                'title' => 'Lubang Segi Enam',
                'subtitle' => 'Lebar 60 x 118 Untuk Panjang Bisa Request',
                'ctas' => [
                    [
                        'title' => 'Hubungi Kami',
                        'url' => '/contact'
                    ]
                ]
            ],
            [
                'badge' => 'Produk Unggulan',
                'tagline' => 'PT. Borneo Iban Jaya Perkasa',
                'title' => 'Speaker',
                'subtitle' => 'Produk speaker berkualitas tinggi dengan berbagai ukuran dan spesifikasi sesuai kebutuhan Anda',
                'ctas' => [
                    [
                        'title' => 'Lihat Produk',
                        'url' => '/products'
                    ],
                    [
                        'title' => 'Hubungi Kami',
                        'url' => '/contact'
                    ]
                ]
            ],
            [
                'badge' => 'Best Seller',
                'tagline' => 'PT. Borneo Iban Jaya Perkasa',
                'title' => 'Bracket TV',
                'subtitle' => '10-43 inch LED TV (Maks 50kg)',
                'ctas' => [
                    [
                        'title' => 'Pesan Sekarang',
                        'url' => '/contact'
                    ]
                ]
            ]
        ];

        // Get existing data to preserve image paths
        $existing = Setting::where('key', 'home_slider_images')->first();
        $sliderData = [];
        
        if ($existing && $existing->value) {
            $existingData = json_decode($existing->value, true);
            if (is_array($existingData) && count($existingData) > 0) {
                // Merge: keep existing image paths, update other fields
                foreach ($defaultSliderData as $index => $newSlide) {
                    if (isset($existingData[$index]) && !empty($existingData[$index]['image'])) {
                        // Keep existing image, update other fields
                        $sliderData[] = array_merge($existingData[$index], [
                            'badge' => $newSlide['badge'],
                            'tagline' => $newSlide['tagline'],
                            'title' => $newSlide['title'],
                            'subtitle' => $newSlide['subtitle'],
                            'ctas' => $newSlide['ctas']
                        ]);
                    } else {
                        // New slide with placeholder image
                        $sliderData[] = array_merge($newSlide, [
                            'image' => '/storage/sliders/slide-' . ($index + 1) . '.webp'
                        ]);
                    }
                }
                
                // Keep any additional existing slides
                if (count($existingData) > count($defaultSliderData)) {
                    for ($i = count($defaultSliderData); $i < count($existingData); $i++) {
                        $sliderData[] = $existingData[$i];
                    }
                }
            } else {
                // No existing data, use defaults with placeholder images
                foreach ($defaultSliderData as $index => $slide) {
                    $sliderData[] = array_merge($slide, [
                        'image' => '/storage/sliders/slide-' . ($index + 1) . '.webp'
                    ]);
                }
            }
        } else {
            // No existing data, use defaults with placeholder images
            foreach ($defaultSliderData as $index => $slide) {
                $sliderData[] = array_merge($slide, [
                    'image' => '/storage/sliders/slide-' . ($index + 1) . '.webp'
                ]);
            }
        }

        Setting::updateOrCreate(
            ['key' => 'home_slider_images'],
            [
                'value' => json_encode($sliderData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'type' => 'json',
                'group' => 'home'
            ]
        );

        $this->command->info('Slider data seeded successfully!');
        $this->command->info('Updated ' . count($sliderData) . ' slider slides with content.');
        $this->command->info('Note: Image paths preserved from existing data. Update in admin if needed.');
    }
}
