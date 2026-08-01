<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Product;
use App\Models\Blog;
use App\Models\HomeSection;
use App\Models\Page;
use App\Services\TrackingService;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Track page view
        TrackingService::trackPageView($request, '/', 'Home');
        
        // Set SEO
        $metaTitle = Setting::get('seo_meta_title');
        $metaDescription = Setting::get('seo_meta_description');
        $metaKeywords = Setting::get('seo_meta_keywords');
        $ogImage = Setting::get('seo_og_image');
        
        SEOTools::setTitle($metaTitle ?: Setting::get('site_name', 'Borneo Jaya'));
        SEOTools::setDescription($metaDescription ?: Setting::get('company_about', ''));
        
        if ($metaKeywords) {
            SEOTools::metatags()->setKeywords(explode(',', $metaKeywords));
        }
        
        if ($ogImage) {
            SEOTools::opengraph()->addImage(url($ogImage));
        }

        // Get all home sections from database
        $bannerSlider = HomeSection::getByKey('banner_slider');
        $aboutSection = HomeSection::getByKey('about');
        $servicesSection = HomeSection::getByKey('services');
        $productsSection = HomeSection::getByKey('products');
        $workProcessSection = HomeSection::getByKey('work_process');
        $whyChooseUsSection = HomeSection::getByKey('why_choose_us');
        $testimonialsSection = HomeSection::getByKey('testimonials');
        $projectsSection = HomeSection::getByKey('projects');
        $blogSection = HomeSection::getByKey('blog');
        
        // Get banner slider slides from extra_data
        $slider_slides = [];
        if ($bannerSlider && !empty($bannerSlider->extra_data['slides']) && is_array($bannerSlider->extra_data['slides'])) {
            $slider_slides = $bannerSlider->extra_data['slides'];
            // Filter out empty slides
            $slider_slides = array_filter($slider_slides, function($slide) {
                return !empty($slide['title']) || !empty($slide['description']);
            });
            // Re-index array
            $slider_slides = array_values($slider_slides);
        }
        
        // Get services from selected_services or fallback to latest
        $services = collect();
        if ($servicesSection && !empty($servicesSection->extra_data['selected_services'])) {
            $serviceIds = $servicesSection->extra_data['selected_services'];
            $services = Service::whereIn('id', $serviceIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $serviceIds) . ')')
                ->get();
        }
        if ($services->isEmpty()) {
            $services = Service::latest()->take(6)->get();
        }
        
        // Get products from selected_products or fallback to latest
        $products = collect();
        if ($productsSection && !empty($productsSection->extra_data['selected_products'])) {
            $productIds = $productsSection->extra_data['selected_products'];
            $products = Product::whereIn('id', $productIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $productIds) . ')')
                ->get();
        }
        if ($products->isEmpty()) {
            $products = Product::latest()->take(8)->get();
        }
        
        // Get blogs from selected_blogs or fallback to latest
        $blogs = collect();
        if ($blogSection && !empty($blogSection->extra_data['selected_blogs'])) {
            $blogIds = $blogSection->extra_data['selected_blogs'];
            $blogs = Blog::where('status', 'published')
                ->whereIn('id', $blogIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $blogIds) . ')')
                ->get();
        }
        if ($blogs->isEmpty()) {
            $blogs = Blog::where('status', 'published')->latest()->take(3)->get();
        }

        // Get section items for sections that use items
        $aboutItems = collect();
        if ($aboutSection) {
            $aboutItems = $aboutSection->items;
        }

        $workProcessItems = collect();
        if ($workProcessSection) {
            $workProcessItems = $workProcessSection->items;
        }

        $whyChooseUsItems = collect();
        if ($whyChooseUsSection) {
            $whyChooseUsItems = $whyChooseUsSection->items;
        }

        $testimonialsItems = collect();
        if ($testimonialsSection) {
            $testimonialsItems = $testimonialsSection->items;
        }

        $projectsItems = collect();
        if ($projectsSection) {
            $projectsItems = $projectsSection->items;
        }
        
        // Legacy support
        $slider_data = Setting::get('home_slider_images', []);
        $welcome_text = Setting::get('home_welcome_text', 'Jasa Logam, Plong & Produksi Accesories');
        
        // Process legacy slider data if no database slides
        if (empty($slider_slides) && !empty($slider_data)) {
            foreach ($slider_data as $item) {
                if (is_string($item)) {
                    $slider_slides[] = [
                        'background_image' => $item,
                        'rating' => '5.0',
                        'rating_text' => '(Terpercaya)',
                        'title' => '',
                        'description' => '',
                        'button1_text' => '',
                        'button1_link' => '',
                        'button2_text' => '',
                        'button2_type' => 'modal',
                        'button2_link' => '',
                        'trust_text' => ''
                    ];
                } else {
                    $slide = [
                        'background_image' => $item['image'] ?? $item,
                        'rating' => $item['rating'] ?? '5.0',
                        'rating_text' => $item['rating_text'] ?? '(Terpercaya)',
                        'title' => $item['title'] ?? '',
                        'description' => $item['subtitle'] ?? ($item['description'] ?? ''),
                        'button1_text' => $item['button1_text'] ?? '',
                        'button1_link' => $item['button1_link'] ?? '',
                        'button2_text' => $item['button2_text'] ?? '',
                        'button2_type' => $item['button2_type'] ?? 'modal',
                        'button2_link' => $item['button2_link'] ?? '',
                        'trust_text' => $item['trust_text'] ?? ''
                    ];
                    $slider_slides[] = $slide;
                }
            }
        }

        // Get CTA settings
        $cta_enabled_setting = Setting::get('cta_enabled', '1');
        $cta_enabled = $cta_enabled_setting === '1' || $cta_enabled_setting === true || $cta_enabled_setting === 1;
        $cta_title = Setting::get('cta_title', 'Butuh Penawaran?');
        $cta_subtitle = Setting::get('cta_subtitle', 'Dapatkan harga terbaik dengan mengisi form di bawah ini');
        $cta_button_text = Setting::get('cta_button_text', 'Request Penawaran');
        $cta_modal_title = Setting::get('cta_modal_title', 'Request Penawaran');
        $cta_modal_subtitle = Setting::get('cta_modal_subtitle', 'Isi form untuk mendapatkan harga terbaik.');
        $cta_form_fields = Setting::get('cta_form_fields', [
            ['name' => 'full_name', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true, 'enabled' => true],
            ['name' => 'domicile', 'label' => 'Domisili (Kota)', 'type' => 'text', 'required' => true, 'enabled' => true],
            ['name' => 'product_name', 'label' => 'Nama Produk', 'type' => 'text', 'required' => true, 'enabled' => true],
            ['name' => 'quantity', 'label' => 'Jumlah (Pcs)', 'type' => 'text', 'required' => true, 'enabled' => true],
            ['name' => 'shipping_destination', 'label' => 'Tujuan Pengiriman', 'type' => 'text', 'required' => false, 'enabled' => true],
            ['name' => 'notes', 'label' => 'Catatan Tambahan (Spek/Ukuran)', 'type' => 'textarea', 'required' => false, 'enabled' => true],
        ]);
        $cta_whatsapp_number = Setting::get('cta_whatsapp_number', '');
        $cta_whatsapp_message = Setting::get('cta_whatsapp_message', '');
        $cta_whatsapp_info = Setting::get('cta_whatsapp_info', 'Lampirkan gambar referensi di WhatsApp setelah klik Kirim.');

        return view('frontend.index', compact(
            'services', 'products', 'blogs', 'slider_slides', 'welcome_text',
            'cta_enabled', 'cta_title', 'cta_subtitle', 'cta_button_text',
            'cta_modal_title', 'cta_modal_subtitle', 'cta_form_fields',
            'cta_whatsapp_number', 'cta_whatsapp_message', 'cta_whatsapp_info',
            'bannerSlider', 'aboutSection', 'servicesSection', 'productsSection',
            'workProcessSection', 'whyChooseUsSection', 'testimonialsSection',
            'projectsSection', 'blogSection',
            'aboutItems', 'workProcessItems', 'whyChooseUsItems',
            'testimonialsItems', 'projectsItems'
        ));
    }

    public function about(Request $request)
    {
        // Track page view
        TrackingService::trackPageView($request, '/about', 'About Us');
        
        // Get page data from database
        $page = Page::where('slug', 'about')->where('is_published', true)->first();
        
        if ($page) {
            // Set SEO from page data
            SEOTools::setTitle(($page->meta_title ?: $page->title) . ' - ' . Setting::get('site_name', 'Borneo Jaya'));
            SEOTools::setDescription($page->meta_description ?: Setting::get('company_about', ''));
            
            if ($page->og_image) {
                SEOTools::opengraph()->addImage(url($page->og_image));
            } elseif ($page->featured_image) {
                SEOTools::opengraph()->addImage(url($page->featured_image));
            }
            
            return view('frontend.about', compact('page'));
        }
        
        // Fallback to old settings-based approach
        $metaTitle = Setting::get('seo_meta_title');
        $metaDescription = Setting::get('seo_meta_description');
        $ogImage = Setting::get('seo_og_image');
        
        SEOTools::setTitle(($metaTitle ? $metaTitle . ' - ' : '') . 'About Us - ' . Setting::get('site_name', 'Borneo Jaya'));
        SEOTools::setDescription($metaDescription ?: Setting::get('company_about', ''));
        
        if ($ogImage) {
            SEOTools::opengraph()->addImage(url($ogImage));
        }

        return view('frontend.about');
    }

    public function services(Request $request)
    {
        // Track page view
        TrackingService::trackPageView($request, '/services', 'Services');
        
        // Get page data from database
        $page = Page::where('slug', 'services')->where('is_published', true)->first();
        
        if ($page) {
            // Set SEO from page data
            SEOTools::setTitle(($page->meta_title ?: $page->title) . ' - ' . Setting::get('site_name', 'Borneo Jaya'));
            SEOTools::setDescription($page->meta_description ?: Setting::get('company_about', ''));
            
            if ($page->og_image) {
                SEOTools::opengraph()->addImage(url($page->og_image));
            } elseif ($page->featured_image) {
                SEOTools::opengraph()->addImage(url($page->featured_image));
            }
        } else {
            // Fallback to old settings-based approach
            $metaTitle = Setting::get('seo_meta_title');
            $metaDescription = Setting::get('seo_meta_description');
            $ogImage = Setting::get('seo_og_image');
            
            SEOTools::setTitle(($metaTitle ? $metaTitle . ' - ' : '') . 'Services - ' . Setting::get('site_name', 'Borneo Jaya'));
            SEOTools::setDescription($metaDescription ?: Setting::get('company_about', ''));
            
            if ($ogImage) {
                SEOTools::opengraph()->addImage(url($ogImage));
            }
        }
        
        $services = Service::latest()->paginate(12);
        return view('frontend.services', compact('services', 'page'));
    }

    public function serviceShow(Request $request, $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        
        // Track page view
        TrackingService::trackPageView($request, '/services/' . $slug, $service->name);
        
        // Set SEO
        $metaTitle = $service->meta_title ?: $service->name;
        $metaDescription = $service->meta_description ?: Str::limit(strip_tags($service->description), 160);
        
        SEOTools::setTitle($metaTitle . ' - ' . Setting::get('site_name', 'Borneo Jaya'));
        SEOTools::setDescription($metaDescription);
        
        if ($service->image) {
            SEOTools::opengraph()->addImage(url($service->image));
        }
        
        // Get related services (exclude current service)
        $relatedServices = Service::where('id', '!=', $service->id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('frontend.service-single', compact('service', 'relatedServices'));
    }

    public function blog(Request $request)
    {
        // Track page view
        TrackingService::trackPageView($request, '/blog', 'Blog');
        
        // Get page data from database
        $page = Page::where('slug', 'blog')->where('is_published', true)->first();
        
        if ($page) {
            // Set SEO from page data
            SEOTools::setTitle(($page->meta_title ?: $page->title) . ' - ' . Setting::get('site_name', 'Borneo Jaya'));
            SEOTools::setDescription($page->meta_description ?: Setting::get('company_about', ''));
            
            if ($page->og_image) {
                SEOTools::opengraph()->addImage(url($page->og_image));
            } elseif ($page->featured_image) {
                SEOTools::opengraph()->addImage(url($page->featured_image));
            }
        } else {
            // Fallback to old settings-based approach
            $metaTitle = Setting::get('seo_meta_title');
            $metaDescription = Setting::get('seo_meta_description');
            $ogImage = Setting::get('seo_og_image');
            
            SEOTools::setTitle(($metaTitle ? $metaTitle . ' - ' : '') . 'Blog - ' . Setting::get('site_name', 'Borneo Jaya'));
            SEOTools::setDescription($metaDescription ?: Setting::get('company_about', ''));
            
            if ($ogImage) {
                SEOTools::opengraph()->addImage(url($ogImage));
            }
        }
        
        $blogs = Blog::where('status', 'published')->latest()->paginate(9);
        return view('frontend.blog', compact('blogs', 'page'));
    }

    public function blogShow(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        
        // Track page view and blog view
        TrackingService::trackPageView($request, '/blog/' . $slug, $blog->title);
        // Note: Blog view tracking is done via JavaScript on frontend
        
        // Set SEO
        $metaTitle = $blog->meta_title ?: $blog->title;
        $metaDescription = $blog->meta_description ?: Str::limit(strip_tags($blog->content), 160);
        
        SEOTools::setTitle($metaTitle . ' - ' . Setting::get('site_name', 'Borneo Jaya'));
        SEOTools::setDescription($metaDescription);
        
        if ($blog->meta_keywords) {
            SEOTools::metatags()->setKeywords(explode(',', $blog->meta_keywords));
        }
        
        if ($blog->image) {
            SEOTools::opengraph()->addImage(url($blog->image));
        }
        
        // Add canonical URL
        SEOTools::metatags()->addMeta('canonical', url('/blog/' . $slug));
        
        // Get related blogs (exclude current blog)
        $relatedBlogs = Blog::where('id', '!=', $blog->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
        
        return view('frontend.blog-single', compact('blog', 'relatedBlogs'));
    }

    public function contact(Request $request)
    {
        // Track page view
        TrackingService::trackPageView($request, '/contact', 'Contact');
        
        // Get page data from database
        $page = Page::where('slug', 'contact')->where('is_published', true)->first();
        
        if ($page) {
            // Set SEO from page data
            SEOTools::setTitle(($page->meta_title ?: $page->title) . ' - ' . Setting::get('site_name', 'Borneo Jaya'));
            SEOTools::setDescription($page->meta_description ?: Setting::get('company_about', ''));
            
            if ($page->og_image) {
                SEOTools::opengraph()->addImage(url($page->og_image));
            } elseif ($page->featured_image) {
                SEOTools::opengraph()->addImage(url($page->featured_image));
            }
        } else {
            // Fallback to old settings-based approach
            $metaTitle = Setting::get('seo_meta_title');
            $metaDescription = Setting::get('seo_meta_description');
            $ogImage = Setting::get('seo_og_image');
            
            SEOTools::setTitle(($metaTitle ? $metaTitle . ' - ' : '') . 'Contact Us - ' . Setting::get('site_name', 'Borneo Jaya'));
            SEOTools::setDescription($metaDescription ?: Setting::get('company_about', ''));
            
            if ($ogImage) {
                SEOTools::opengraph()->addImage(url($ogImage));
            }
        }

        $phone = Setting::get('contact_phone', '');
        $email = Setting::get('contact_email', '');
        $address = Setting::get('contact_address', '');

        return view('frontend.contact', compact('phone', 'email', 'address', 'page'));
    }

    public function products(Request $request)
    {
        // Track page view
        TrackingService::trackPageView($request, '/products', 'Products');
        
        // Get page data from database
        $page = Page::where('slug', 'products')->where('is_published', true)->first();
        
        if ($page) {
            // Set SEO from page data
            SEOTools::setTitle(($page->meta_title ?: $page->title) . ' - ' . Setting::get('site_name', 'Borneo Jaya'));
            SEOTools::setDescription($page->meta_description ?: Setting::get('company_about', ''));
            
            if ($page->og_image) {
                SEOTools::opengraph()->addImage(url($page->og_image));
            } elseif ($page->featured_image) {
                SEOTools::opengraph()->addImage(url($page->featured_image));
            }
        } else {
            // Fallback to old settings-based approach
            $metaTitle = Setting::get('seo_meta_title');
            $metaDescription = Setting::get('seo_meta_description');
            $ogImage = Setting::get('seo_og_image');
            
            SEOTools::setTitle(($metaTitle ? $metaTitle . ' - ' : '') . 'Products - ' . Setting::get('site_name', 'Borneo Jaya'));
            SEOTools::setDescription($metaDescription ?: Setting::get('company_about', ''));
            
            if ($ogImage) {
                SEOTools::opengraph()->addImage(url($ogImage));
            }
        }
        
        $products = Product::latest()->paginate(12);
        return view('frontend.products', compact('products', 'page'));
    }

    public function product(Request $request, $slug)
    {
        // Track page view
        TrackingService::trackPageView($request, '/products/' . $slug, 'Product Detail');
        
        $product = Product::where('slug', $slug)->firstOrFail();
        
        // Set SEO
        $metaTitle = $product->meta_title ?: $product->name;
        $metaDescription = $product->meta_description ?: Str::limit(strip_tags($product->description), 160);
        
        SEOTools::setTitle($metaTitle . ' - ' . Setting::get('site_name', 'Borneo Jaya'));
        SEOTools::setDescription($metaDescription);
        
        if ($product->image) {
            SEOTools::opengraph()->addImage(url($product->image));
        }
        
        // Get related products (exclude current product)
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }
}
