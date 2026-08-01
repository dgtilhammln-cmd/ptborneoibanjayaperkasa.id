<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use App\Models\HomeSectionItem;
use App\Services\ImageService;
use Illuminate\Http\Request;

class HomeContentController extends Controller
{
    public function index()
    {
        $sections = HomeSection::orderBy('order')->get();
        return view('admin.home-content.index', compact('sections'));
    }

    public function edit($key)
    {
        // Get section without active filter for admin
        $section = HomeSection::where('key', $key)->first();
        
        if (!$section) {
            // Create default section if not exists
            $defaultExtraData = [];
            
            // Add default slides for banner_slider
            if ($key == 'banner_slider') {
                $defaultExtraData = [
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
                            'trust_text' => 'Terpercaya dengan pengalaman sejak 2003',
                            'trust_image' => 'assets/img/barfi/Landscaping/banner/vl-banner-auth5.png'
                        ]
                    ]
                ];
            }
            
            $section = HomeSection::create([
                'key' => $key,
                'title' => $this->getDefaultTitle($key),
                'heading' => $this->getDefaultHeading($key),
                'subtitle' => $this->getDefaultSubtitle($key),
                'is_active' => true,
                'order' => $this->getDefaultOrder($key),
                'extra_data' => $defaultExtraData
            ]);
        }

        $items = $section->allItems()->orderBy('order')->get();
        return view('admin.home-content.edit', compact('section', 'items'));
    }

    public function update(Request $request, $key)
    {
        $section = HomeSection::where('key', $key)->firstOrFail();

        $data = $request->only([
            'title', 'heading', 'subtitle', 'content', 'video_url', 
            'is_active', 'order'
        ]);
        
        // Ensure is_active is boolean
        if (isset($data['is_active'])) {
            $data['is_active'] = (bool) $data['is_active'];
        }

        // Handle selected items for services, products, blog
        if (in_array($key, ['services', 'products', 'blog'])) {
            $extraData = $section->extra_data ?? [];
            
            if ($key == 'services' && $request->has('selected_services')) {
                $extraData['selected_services'] = $request->input('selected_services', []);
            }
            
            if ($key == 'products' && $request->has('selected_products')) {
                $extraData['selected_products'] = $request->input('selected_products', []);
            }
            
            if ($key == 'blog' && $request->has('selected_blogs')) {
                $extraData['selected_blogs'] = $request->input('selected_blogs', []);
            }
            
            $data['extra_data'] = $extraData;
        }
        
        // Handle banner slider
        if ($key == 'banner_slider') {
            $slides = [];
            
            // Process slides from form
            if ($request->has('slides') && is_array($request->input('slides'))) {
                foreach ($request->input('slides') as $index => $slideData) {
                    // Skip empty slides
                    if (empty($slideData['title']) && empty($slideData['description'])) {
                        continue;
                    }
                    
                    $slide = [
                        'rating' => $slideData['rating'] ?? '5.0',
                        'rating_text' => $slideData['rating_text'] ?? '(Terpercaya)',
                        'title' => $slideData['title'] ?? '',
                        'description' => $slideData['description'] ?? '',
                        'button1_text' => $slideData['button1_text'] ?? '',
                        'button1_link' => $slideData['button1_link'] ?? '',
                        'button2_text' => $slideData['button2_text'] ?? '',
                        'button2_type' => $slideData['button2_type'] ?? 'modal',
                        'button2_link' => $slideData['button2_link'] ?? '',
                        'trust_text' => $slideData['trust_text'] ?? ''
                    ];
                    
                    // Handle background image
                    if ($request->hasFile("slides.{$index}.background_image")) {
                        $file = $request->file("slides.{$index}.background_image");
                        $slide['background_image'] = ImageService::uploadAndConvert($file, 'home-sections/banner');
                    } elseif (!empty($slideData['background_image_existing'])) {
                        $slide['background_image'] = $slideData['background_image_existing'];
                    } else {
                        // Keep existing image if no new upload
                        $existingSlides = $section->extra_data['slides'] ?? [];
                        if (isset($existingSlides[$index]['background_image'])) {
                            $slide['background_image'] = $existingSlides[$index]['background_image'];
                    } else {
                        $slide['background_image'] = '';
                        }
                    }
                    
                    // Handle trust image
                    if ($request->hasFile("slides.{$index}.trust_image")) {
                        $file = $request->file("slides.{$index}.trust_image");
                        $slide['trust_image'] = ImageService::uploadAndConvert($file, 'home-sections/banner');
                    } elseif (!empty($slideData['trust_image_existing'])) {
                        $slide['trust_image'] = $slideData['trust_image_existing'];
                    } else {
                        // Keep existing image if no new upload
                        $existingSlides = $section->extra_data['slides'] ?? [];
                        if (isset($existingSlides[$index]['trust_image'])) {
                            $slide['trust_image'] = $existingSlides[$index]['trust_image'];
                    } else {
                        $slide['trust_image'] = '';
                        }
                    }
                    
                    $slides[] = $slide;
                }
            }
            
            // Also check for slider_data JSON (from JavaScript submission)
            if ($request->has('slider_data')) {
                $sliderDataJson = $request->input('slider_data');
                $sliderData = json_decode($sliderDataJson, true);
                
                if (is_array($sliderData) && !empty($sliderData)) {
                    foreach ($sliderData as $index => $slide) {
                        // Handle file uploads
                        if ($request->hasFile("slides.{$index}.background_image")) {
                            $file = $request->file("slides.{$index}.background_image");
                            $sliderData[$index]['background_image'] = ImageService::uploadAndConvert($file, 'home-sections/banner');
                        } elseif (!empty($slide['background_image']) && $slide['background_image'] != 'upload') {
                            $sliderData[$index]['background_image'] = $slide['background_image'];
                        }
                        
                        if ($request->hasFile("slides.{$index}.trust_image")) {
                            $file = $request->file("slides.{$index}.trust_image");
                            $sliderData[$index]['trust_image'] = ImageService::uploadAndConvert($file, 'home-sections/banner');
                        } elseif (!empty($slide['trust_image']) && $slide['trust_image'] != 'upload') {
                            $sliderData[$index]['trust_image'] = $slide['trust_image'];
                        }
                    }
                    $slides = $sliderData;
                }
            }
            
            // Always set extra_data for banner_slider, even if empty
                $data['extra_data'] = ['slides' => $slides];
        }

        // Handle images
        if ($request->hasFile('image')) {
            if ($section->image) {
                ImageService::delete($section->image);
            }
            $data['image'] = ImageService::uploadAndConvert($request->file('image'), 'home-sections');
        }

        if ($request->hasFile('image_2')) {
            if ($section->image_2) {
                ImageService::delete($section->image_2);
            }
            $data['image_2'] = ImageService::uploadAndConvert($request->file('image_2'), 'home-sections');
        }

        if ($request->hasFile('image_3')) {
            if ($section->image_3) {
                ImageService::delete($section->image_3);
            }
            $data['image_3'] = ImageService::uploadAndConvert($request->file('image_3'), 'home-sections');
        }

        // Handle extra_data for other sections
        if ($request->has('extra_data') && $key != 'banner_slider') {
            $data['extra_data'] = json_decode($request->input('extra_data'), true);
        }
        
        // Handle specific fields for different sections
        if ($key == 'about') {
            $extraData = $section->extra_data ?? [];
            if ($request->has('button_text')) {
                $extraData['button_text'] = $request->input('button_text');
            }
            if ($request->has('button_link')) {
                $extraData['button_link'] = $request->input('button_link');
            }
            $data['extra_data'] = $extraData;
        }
        
        if ($key == 'work_process') {
            $extraData = $section->extra_data ?? [];
            if ($request->has('tag_cloud')) {
                $extraData['tag_cloud'] = $request->input('tag_cloud');
            }
            $data['extra_data'] = $extraData;
        }

        $section->update($data);

        // Refresh section to get updated data
        $section->refresh();

        return redirect()->route('admin.home-content.index')->with('success', 'Section updated successfully.');
    }

    public function storeItem(Request $request, $key)
    {
        $section = HomeSection::where('key', $key)->firstOrFail();

        $data = $request->only([
            'type', 'title', 'description', 'content', 'icon', 
            'link', 'link_text', 'is_active', 'order'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = ImageService::uploadAndConvert($request->file('image'), 'home-section-items');
        }

        // Handle extra_data based on section type
        $extraData = [];
        
        if ($key == 'products') {
            if ($request->has('price')) {
                $extraData['price'] = $request->input('price');
            }
            if ($request->has('category')) {
                $extraData['category'] = $request->input('category');
            }
        }
        
        if ($key == 'testimonials') {
            if ($request->has('author_name')) {
                $extraData['author_name'] = $request->input('author_name');
            }
            if ($request->has('author_position')) {
                $extraData['author_position'] = $request->input('author_position');
            }
            if ($request->has('rating')) {
                $extraData['rating'] = $request->input('rating');
            }
        }
        
        if ($key == 'work_process') {
            if ($request->has('step_number')) {
                $extraData['step_number'] = $request->input('step_number');
            }
        }
        
        if ($key == 'projects') {
            if ($request->has('category')) {
                $extraData['category'] = $request->input('category');
            }
        }
        
        if (!empty($extraData)) {
            $data['extra_data'] = $extraData;
        } elseif ($request->has('extra_data')) {
            $data['extra_data'] = json_decode($request->input('extra_data'), true);
        }

        $data['home_section_id'] = $section->id;
        $data['order'] = $data['order'] ?? ($section->allItems()->max('order') ?? 0) + 1;

        HomeSectionItem::create($data);

        return redirect()->back()->with('success', 'Item added successfully.');
    }

    public function updateItem(Request $request, $key, $itemId)
    {
        $item = HomeSectionItem::findOrFail($itemId);

        $data = $request->only([
            'type', 'title', 'description', 'content', 'icon',
            'link', 'link_text', 'is_active', 'order'
        ]);

        if ($request->hasFile('image')) {
            if ($item->image) {
                ImageService::delete($item->image);
            }
            $data['image'] = ImageService::uploadAndConvert($request->file('image'), 'home-section-items');
        }

        // Handle extra_data based on section type
        $extraData = $item->extra_data ?? [];
        
        if ($key == 'products') {
            if ($request->has('price')) {
                $extraData['price'] = $request->input('price');
            }
            if ($request->has('category')) {
                $extraData['category'] = $request->input('category');
            }
        }
        
        if ($key == 'testimonials') {
            if ($request->has('author_name')) {
                $extraData['author_name'] = $request->input('author_name');
            }
            if ($request->has('author_position')) {
                $extraData['author_position'] = $request->input('author_position');
            }
            if ($request->has('rating')) {
                $extraData['rating'] = $request->input('rating');
            }
        }
        
        if ($key == 'work_process') {
            if ($request->has('step_number')) {
                $extraData['step_number'] = $request->input('step_number');
            }
        }
        
        if ($key == 'projects') {
            if ($request->has('category')) {
                $extraData['category'] = $request->input('category');
            }
        }
        
        if (!empty($extraData)) {
            $data['extra_data'] = $extraData;
        } elseif ($request->has('extra_data')) {
            $data['extra_data'] = json_decode($request->input('extra_data'), true);
        }

        $item->update($data);

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    public function destroyItem($key, $itemId)
    {
        $item = HomeSectionItem::findOrFail($itemId);
        if ($item->image) {
            ImageService::delete($item->image);
        }
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }

    private function getDefaultTitle($key)
    {
        $titles = [
            'banner_slider' => 'Banner / Hero Slider',
            'about' => 'Tentang Kami',
            'services' => 'Layanan Kami',
            'products' => 'Produk Kami',
            'projects' => 'Projects',
            'work_process' => 'Cara Kami Bekerja',
            'why_choose_us' => 'Mengapa Pilih Kami',
            'testimonials' => 'Testimoni',
            'blog' => 'Blog Kami'
        ];
        return $titles[$key] ?? '';
    }

    private function getDefaultHeading($key)
    {
        $headings = [
            'banner_slider' => '',
            'about' => 'Solusi Terpercaya untuk Kebutuhan Jasa Logam & Produksi Sparepart',
            'services' => 'Layanan Profesional untuk Kebutuhan Industri Anda',
            'products' => 'Produk Berkualitas untuk Kebutuhan Anda',
            'projects' => '',
            'work_process' => 'Proses Produksi yang Terpercaya, Langkah demi Langkah',
            'why_choose_us' => 'Kualitas & Kepercayaan, Setiap Proyek, Setiap Detail',
            'testimonials' => 'Apa Kata Klien Kami',
            'blog' => 'Tips, Informasi & Update Terbaru dari Industri'
        ];
        return $headings[$key] ?? '';
    }

    private function getDefaultSubtitle($key)
    {
        $subtitles = [
            'banner_slider' => '',
            'about' => 'PT. Borneo Iban Jaya Perkasa adalah perusahaan yang bergerak di bidang jasa logam, plong, dan produksi aksesori serta suku cadang berkualitas tinggi. Dengan pengalaman sejak 2003, kami melayani kebutuhan industri dan otomotif dengan komitmen terhadap kualitas dan kepuasan pelanggan.',
            'services' => '',
            'products' => '',
            'projects' => '',
            'work_process' => '',
            'why_choose_us' => 'Memilih PT. Borneo Iban Jaya Perkasa berarti memilih tim yang peduli dengan kebutuhan industri Anda. Kami menggabungkan pengalaman, presisi, dan keandalan untuk memberikan produk dan jasa berkualitas tinggi yang memenuhi standar industri.',
            'testimonials' => '',
            'blog' => ''
        ];
        return $subtitles[$key] ?? '';
    }

    private function getDefaultOrder($key)
    {
        $orders = [
            'banner_slider' => 1,
            'about' => 2,
            'services' => 3,
            'products' => 4,
            'projects' => 5,
            'work_process' => 6,
            'why_choose_us' => 7,
            'testimonials' => 8,
            'blog' => 9
        ];
        return $orders[$key] ?? 0;
    }
}
