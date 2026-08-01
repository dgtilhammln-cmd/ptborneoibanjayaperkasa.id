<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageContentController extends Controller
{
    /**
     * List all page content management pages
     */
    public function index()
    {
        $pages = [
            'about' => ['name' => 'About Page', 'icon' => 'mdi-information-outline', 'slug' => 'about'],
            'services' => ['name' => 'Services Page', 'icon' => 'mdi-tools', 'slug' => 'services'],
            'products' => ['name' => 'Products Page', 'icon' => 'mdi-package-variant-closed', 'slug' => 'products'],
            'blog' => ['name' => 'Blog Page', 'icon' => 'mdi-post-outline', 'slug' => 'blog'],
            'contact' => ['name' => 'Contact Page', 'icon' => 'mdi-phone', 'slug' => 'contact'],
        ];

        return view('admin.page-content.index', compact('pages'));
    }

    /**
     * Show edit form for specific page
     */
    public function edit($pageKey)
    {
        $page = Page::where('slug', $pageKey)->first();
        
        if (!$page) {
            // Create page if doesn't exist
            $page = Page::create([
                'title' => ucfirst($pageKey),
                'slug' => $pageKey,
                'is_published' => true,
                'sections' => $this->getDefaultSections($pageKey),
            ]);
        }

        return view('admin.page-content.edit', compact('page', 'pageKey'));
    }

    /**
     * Update page content
     */
    public function update(Request $request, $pageKey)
    {
        $page = Page::where('slug', $pageKey)->firstOrFail();

        $data = $request->except(['_token', '_method', 'sections']);
        
        // Handle sections based on page type
        $sections = $this->processSections($request, $pageKey);
        $data['sections'] = $sections;

        // Handle images (this will update $data['sections'] with uploaded images)
        $this->handleImages($request, $page, $data, $pageKey);

        $page->update($data);

        return redirect()->route('admin.page-content.index')->with('success', 'Page content updated successfully.');
    }

    /**
     * Get default sections for each page
     */
    private function getDefaultSections($pageKey)
    {
        $defaults = [
            'about' => [
                'breadcrumb' => [
                    'title' => 'About Us',
                    'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg',
                ],
                'about_section' => [
                    'subtitle' => 'About us',
                    'heading' => 'Committed To Keeping Your Property Safe All Winter',
                    'description' => 'At Barfi, we believe winter should be enjoyed not endured. That\'s why we\'ve built our reputation delivering fast, reliable, & professional.',
                    'image_1' => 'assets/img/barfi/SnowRemovalTwo/about/vl-about2.1.png',
                    'image_2' => 'assets/img/barfi/SnowRemovalTwo/about/vl-about2.2.png',
                    'counter_1_number' => '12+',
                    'counter_1_text' => 'Years of Experience Over years keeping homes and businesses safe from winter.',
                    'counter_2_number' => '24/7',
                    'counter_2_text' => 'Availability We\'re ready to clear snow anytime, day or night.',
                ],
                'fact_section' => [
                    'subtitle' => 'Interesting Facts',
                    'facts' => [
                        ['number' => '500', 'symbol' => '+', 'text' => 'Cleared Every Winter'],
                        ['number' => '24/7', 'symbol' => '', 'text' => 'Emergency Snow Removal'],
                        ['number' => '100', 'symbol' => '%', 'text' => 'Customer Satisfaction'],
                        ['number' => '12', 'symbol' => '+', 'text' => 'Years of Barfi Experience'],
                    ],
                ],
                'choose_section' => [
                    'subtitle' => 'Why Choose Us',
                    'heading' => 'At Barfi, our mission is to keep your property safe the, accessible, and worry-free all season long.',
                    'description' => 'When winter hits hard, you need a snow removal team you can count on and that\'s exactly what we deliver. We combine experience, reliability, and advanced equipment to provide fast, efficient.',
                    'image' => 'assets/img/barfi/SnowRemovalOne/choose/vl-choose-thumb-inner1.1.png',
                    'features' => [
                        ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.1.svg', 'title' => 'Experienced Professionals', 'description' => 'Our team is highly trained & experienced handling all types of snow ice conditions.'],
                        ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.2.svg', 'title' => 'Modern Equipment', 'description' => 'Using high-performance plows, blowers, and de-icing tools for precise, damage.'],
                        ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.3.svg', 'title' => 'Customer Satisfaction Guaranty', 'description' => 'We go the extra mile to ensure every client stays safe satisfied all winter long.'],
                        ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.4.svg', 'title' => '24/7 Emergency Service', 'description' => 'We\'re always ready when the storm hits — day or night, weekend or holiday.'],
                        ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.5.svg', 'title' => 'Reliable & On-Time', 'description' => 'We monitor weather patterns to arrive before accumulation becomes a problem.'],
                        ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.6.svg', 'title' => 'Fully Licensed & Insured', 'description' => 'Your property is protected with team that follows the highest safety and quality.'],
                    ],
                ],
                'work_section' => [
                    'subtitle' => 'How It Work',
                    'heading' => 'Step-By-Step Snow And Ice Management',
                    'steps' => [
                        ['number' => '01', 'title' => 'Book Your Service', 'description' => 'Get started by contacting us online or by phone. Tell us about your property and snow removal needs.'],
                        ['number' => '02', 'title' => 'We Monitor the Weather', 'description' => 'Our team keeps an eye on every forecast, so you don\'t have to. As soon as the snow begins to fall.'],
                        ['number' => '03', 'title' => 'Fast Snow Removal', 'description' => 'When the snow hit our crew arrives time with professional equipment to clear driveways, walkways.'],
                    ],
                ],
                'value_section' => [
                    'subtitle' => 'Our Core Values',
                    'heading' => 'When winter strikes, you need a team that moves fast & delivers.',
                    'description' => 'With state-of-the-art equipment, a highly trained crew, and a commitment to safety and reliability, we clear your property efficiently so you can stay safe and worry-free. No storm is too big, no driveway too long — we\'re here to keep your world moving, even in the harshest conditions.',
                    'image' => 'assets/img/barfi/SnowRemovalOne/service/vl-value-thumb1.1.png',
                    'mission_title' => 'Our Mission',
                    'mission_text' => 'Our mission is to provide fast, reliable and professional snow removal services that keep clients\' properties safe accessible all winter long. We\'re dedicate to delivering exceptional results through dependable.',
                    'vision_title' => 'Our Vision',
                    'vision_text' => 'Our vision is to become the most trusted & recognized snow and ice management company in the region — known for our integrity, efficiency,  innovative approach to winter maintenance.',
                ],
                'testimonial_section' => [
                    'subtitle' => 'Testimonials',
                    'heading' => 'Our Customers Love The Results We Deliver',
                    'testimonials' => [
                        ['quote' => 'The did amazing job removing a huge tree from my backyard. The team was professional, quick, and cleaned everything perfectly. Highly recommend!', 'author' => 'Kenneth Allen', 'position' => 'Homeowner', 'image' => 'assets/img/barfi/SnowRemovalOne/testimonial/testimonial1.1.png'],
                        ['quote' => 'After a storm knocked down a tree near our driveway, they responded quickly and had it cleared within hours. Couldn\'t be happier with the service!', 'author' => 'Stephanie Nicol', 'position' => 'Business Owner', 'image' => 'assets/img/barfi/SnowRemovalOne/testimonial/testimonial1.2.png'],
                        ['quote' => 'The crew was polite, efficient, and made sure everything was done safely. I\'ll definitely use them again for future tree the  services. Highly recommend!', 'author' => 'Corina McCoy', 'position' => 'Property Manager', 'image' => 'assets/img/barfi/SnowRemovalOne/testimonial/testimonial1.3.png'],
                    ],
                ],
                'team_section' => [
                    'subtitle' => 'Our Team',
                    'heading' => 'Our Skilled Landscaping And Snow Removal Experts',
                    'members' => [
                        ['name' => 'Patricia Sanders', 'position' => 'Lead Landscaper', 'image' => 'assets/img/barfi/LawnCare/team/vl-team4.1.png'],
                        ['name' => 'Sarah Thompson', 'position' => 'Lawn Care Specialist', 'image' => 'assets/img/barfi/LawnCare/team/vl-team4.2.png'],
                        ['name' => 'David Carter', 'position' => 'Snow Removal Supervisor', 'image' => 'assets/img/barfi/LawnCare/team/vl-team4.3.png'],
                        ['name' => 'Michael Brown', 'position' => 'Customer Care Manager', 'image' => 'assets/img/barfi/LawnCare/team/vl-team4.4.png'],
                    ],
                ],
            ],
            'services' => [
                'breadcrumb' => [
                    'title' => 'Our Services',
                    'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg',
                ],
                'work_section' => [
                    'subtitle' => 'Cara Kami Bekerja',
                    'heading' => 'Proses Layanan Jasa Logam & Produksi Sparepart',
                    'background_image' => 'assets/img/barfi/shape/fact-shape-about-bg.svg',
                    'steps' => [
                        ['number' => '01', 'title' => 'Konsultasi & Permintaan', 'description' => 'Hubungi kami melalui WhatsApp atau email untuk konsultasi kebutuhan Anda. Jelaskan spesifikasi, jumlah, dan detail proyek yang Anda butuhkan.'],
                        ['number' => '02', 'title' => 'Analisis & Penawaran', 'description' => 'Tim kami akan menganalisis kebutuhan Anda dan menyiapkan penawaran yang sesuai dengan spesifikasi, budget, dan timeline yang diinginkan.'],
                        ['number' => '03', 'title' => 'Produksi & Pengiriman', 'description' => 'Setelah disetujui, kami memulai proses produksi dengan kontrol kualitas ketat dan mengirimkan hasil sesuai jadwal yang telah disepakati.'],
                    ],
                ],
                'contact_section' => [
                    'subtitle' => 'Hubungi Kami',
                    'heading' => 'Layanan Profesional untuk Kebutuhan Industri Anda',
                    'contact_title' => 'Get In Touch With Us',
                    'contact_description' => 'Ada pertanyaan tentang layanan kami? Tim profesional kami siap membantu Anda. Hubungi kami untuk konsultasi gratis, penawaran, atau informasi lebih lanjut tentang jasa bubut, stamping, moulding, dan produksi sparepart.',
                    'contact_cards' => [
                        ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.1.svg', 'title' => 'Alamat', 'text' => 'Jl. Raya Industri No. 123, Surabaya, Jawa Timur'],
                        ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.2.svg', 'title' => 'WhatsApp', 'text' => '031-8559-7449'],
                        ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.3.svg', 'title' => 'Jam Operasional', 'text' => 'Senin - Jumat: 08:00 - 17:00 WIB'],
                        ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.4.svg', 'title' => 'Email', 'text' => 'info@borneoibanjaya.com'],
                    ],
                ],
            ],
            'products' => [
                'breadcrumb' => [
                    'title' => 'Our Products',
                    'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg',
                ],
            ],
            'blog' => [
                'breadcrumb' => [
                    'title' => 'Our Blog',
                    'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg',
                ],
            ],
            'contact' => [
                'breadcrumb' => [
                    'title' => 'Contact Us',
                    'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg',
                ],
                'contact_section' => [
                    'subtitle' => 'Contact Us',
                    'heading' => 'Connect with Barfi Your Local Snow Experts',
                    'description' => 'Don\'t let winter weather slow you down! Our dedicated snow removal team is ready to keep your home or business safe, clear, & accessible.',
                    'image' => 'assets/img/barfi/SnowRemovalOne/contact/vl-contact-thumb1.png',
                    'form_title' => 'Get In Touch With Us',
                ],
                'contact_cards' => [
                    ['icon' => 'assets/img/barfi/icon/vl-contact-icon1.1.svg', 'icon_type' => 'image', 'title' => 'Email Address', 'content' => ['Barfi@gmail.com', 'lorri73@gmail.com']],
                    ['icon' => 'whatsapp', 'icon_type' => 'whatsapp', 'title' => 'Contact Us', 'content' => ['031-8559-7449']],
                    ['icon' => 'assets/img/barfi/icon/vl-contact-icon1.3.svg', 'icon_type' => 'image', 'title' => 'Head Office:', 'content' => ['657 Twin Lakes Drive, Reno, NV 89523']],
                    ['icon' => 'assets/img/barfi/icon/vl-contact-icon1.4.svg', 'icon_type' => 'image', 'title' => 'Works Time:', 'content' => ['We Are Available 24 Hours A Day, 6 Days A Week']],
                ],
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193596.26002810575!2d-74.14431235114544!3d40.69728463488439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2589a018531e3%3A0xb9df1f7387a94119!2sCentral%20Park!5e0!3m2!1sen!2sbd!4v1762656769779!5m2!1sen!2sbd',
            ],
        ];

        return $defaults[$pageKey] ?? [];
    }

    /**
     * Process sections from request
     */
    private function processSections(Request $request, $pageKey)
    {
        if ($pageKey == 'about') {
            return $this->processAboutSections($request);
        } elseif ($pageKey == 'contact') {
            return $this->processContactSections($request);
        } else {
            return $this->processSimpleSections($request, $pageKey);
        }
    }

    /**
     * Process About page sections
     */
    private function processAboutSections(Request $request)
    {
        $sections = [];

        // Breadcrumb
        if ($request->has('breadcrumb')) {
            $breadcrumb = $request->breadcrumb;
            // Checkbox: jika ada di request berarti checked (true), jika tidak ada berarti unchecked (false)
            $breadcrumb['is_active'] = $request->has('breadcrumb.is_active') && $request->input('breadcrumb.is_active') == '1';
            $sections['breadcrumb'] = $breadcrumb;
        }

        // About Section
        if ($request->has('about_section')) {
            $aboutSection = $request->about_section;
            // Checkbox: jika ada di request berarti checked (true), jika tidak ada berarti unchecked (false)
            $aboutSection['is_active'] = $request->has('about_section.is_active') && $request->input('about_section.is_active') == '1';
            $sections['about_section'] = $aboutSection;
        }

        // Fact Section
        if ($request->has('fact_section')) {
            $sections['fact_section'] = [
                'subtitle' => $request->input('fact_section.subtitle'),
                'facts' => $request->input('fact_section.facts', []),
                'is_active' => $request->has('fact_section.is_active') && $request->input('fact_section.is_active') == '1',
            ];
        }

        // Choose Section
        if ($request->has('choose_section')) {
            $sections['choose_section'] = [
                'subtitle' => $request->input('choose_section.subtitle'),
                'heading' => $request->input('choose_section.heading'),
                'description' => $request->input('choose_section.description'),
                'image' => $request->input('choose_section.image_existing'),
                'features' => $request->input('choose_section.features', []),
                'is_active' => $request->has('choose_section.is_active') && $request->input('choose_section.is_active') == '1',
            ];
        }

        // Work Section
        if ($request->has('work_section')) {
            $sections['work_section'] = [
                'subtitle' => $request->input('work_section.subtitle'),
                'heading' => $request->input('work_section.heading'),
                'steps' => $request->input('work_section.steps', []),
                'is_active' => $request->has('work_section.is_active') && $request->input('work_section.is_active') == '1',
            ];
        }

        // Value Section
        if ($request->has('value_section')) {
            $sections['value_section'] = [
                'subtitle' => $request->input('value_section.subtitle'),
                'heading' => $request->input('value_section.heading'),
                'description' => $request->input('value_section.description'),
                'image' => $request->input('value_section.image_existing'),
                'mission_title' => $request->input('value_section.mission_title'),
                'mission_text' => $request->input('value_section.mission_text'),
                'vision_title' => $request->input('value_section.vision_title'),
                'vision_text' => $request->input('value_section.vision_text'),
                'is_active' => $request->has('value_section.is_active') && $request->input('value_section.is_active') == '1',
            ];
        }

        // Testimonial Section
        if ($request->has('testimonial_section')) {
            $sections['testimonial_section'] = [
                'subtitle' => $request->input('testimonial_section.subtitle'),
                'heading' => $request->input('testimonial_section.heading'),
                'testimonials' => $request->input('testimonial_section.testimonials', []),
                'is_active' => $request->has('testimonial_section.is_active') && $request->input('testimonial_section.is_active') == '1',
            ];
        }

        // Team Section
        if ($request->has('team_section')) {
            $sections['team_section'] = [
                'subtitle' => $request->input('team_section.subtitle'),
                'heading' => $request->input('team_section.heading'),
                'members' => $request->input('team_section.members', []),
                'is_active' => $request->has('team_section.is_active') && $request->input('team_section.is_active') == '1',
            ];
        }

        return $sections;
    }

    /**
     * Process Contact page sections
     */
    private function processContactSections(Request $request)
    {
        $sections = [];

        // Breadcrumb
        if ($request->has('sections.breadcrumb') || $request->has('breadcrumb')) {
            $breadcrumb = $request->input('sections.breadcrumb', $request->breadcrumb ?? []);
            $breadcrumb['is_active'] = ($request->has('sections.breadcrumb.is_active') && $request->input('sections.breadcrumb.is_active') == '1')
                || ($request->has('breadcrumb.is_active') && $request->input('breadcrumb.is_active') == '1');
            $sections['breadcrumb'] = $breadcrumb;
        }

        // Contact Section
        if ($request->has('sections.contact_section') || $request->has('contact_section')) {
            $sections['contact_section'] = [
                'subtitle' => $request->input('sections.contact_section.subtitle', $request->input('contact_section.subtitle')),
                'heading' => $request->input('sections.contact_section.heading', $request->input('contact_section.heading')),
                'description' => $request->input('sections.contact_section.description', $request->input('contact_section.description')),
                'image' => $request->input('sections.contact_section.image_existing', $request->input('contact_section.image_existing')),
                'form_title' => $request->input('sections.contact_section.form_title', $request->input('contact_section.form_title')),
                'is_active' => ($request->has('sections.contact_section.is_active') && $request->input('sections.contact_section.is_active') == '1')
                    || ($request->has('contact_section.is_active') && $request->input('contact_section.is_active') == '1'),
            ];
        }

        // Contact Cards - handled in handleContactImages
        if ($request->has('contact_cards')) {
            $cards = [];
            $contactCards = $request->input('contact_cards', []);
            foreach ($contactCards as $index => $card) {
                $cardData = [
                    'title' => $card['title'] ?? '',
                ];
                
                // Handle icon
                if (isset($card['icon_type']) && $card['icon_type'] == 'whatsapp') {
                    $cardData['icon'] = 'whatsapp';
                } elseif (!empty($card['icon_existing'])) {
                    $cardData['icon'] = $card['icon_existing'];
                } else {
                    $cardData['icon'] = '';
                }
                
                // Handle content (split by newline)
                if (!empty($card['content_text'])) {
                    $cardData['content'] = array_filter(array_map('trim', explode("\n", $card['content_text'])));
                } else {
                    $cardData['content'] = [];
                }
                
                $cards[] = $cardData;
            }
            $sections['contact_cards'] = $cards;
        }

        // Contact Cards - handled in handleContactImages
        if ($request->has('sections.contact_cards')) {
            $cards = [];
            $contactCards = $request->input('sections.contact_cards', []);
            foreach ($contactCards as $index => $card) {
                $cardData = [
                    'title' => $card['title'] ?? '',
                ];
                
                // Handle icon
                if (isset($card['icon_type']) && $card['icon_type'] == 'whatsapp') {
                    $cardData['icon'] = 'whatsapp';
                } elseif (!empty($card['icon_existing'])) {
                    $cardData['icon'] = $card['icon_existing'];
                } else {
                    $cardData['icon'] = '';
                }
                
                // Handle content (split by newline)
                if (!empty($card['content_text'])) {
                    $cardData['content'] = array_filter(array_map('trim', explode("\n", $card['content_text'])));
                } else {
                    $cardData['content'] = [];
                }
                
                $cards[] = $cardData;
            }
            $sections['contact_cards'] = $cards;
            // Add is_active for contact_cards
            $sections['contact_cards']['is_active'] = $request->has('sections.contact_cards.is_active') && $request->input('sections.contact_cards.is_active') == '1';
        }

        // Map URL
        if ($request->has('sections.map_url')) {
            $sections['map_url'] = $request->input('sections.map_url');
        }
        
        // Map Section is_active
        if ($request->has('sections.map_section.is_active')) {
            if (!isset($sections['map_section'])) {
                $sections['map_section'] = [];
            }
            $sections['map_section']['is_active'] = $request->input('sections.map_section.is_active') == '1';
        }

        return $sections;
    }

    /**
     * Process simple sections (services, products, blog)
     */
    private function processSimpleSections(Request $request, $pageKey)
    {
        $sections = [];

        // Handle breadcrumb
        if ($request->has('breadcrumb')) {
            $breadcrumb = $request->breadcrumb;
            $breadcrumb['is_active'] = $request->has('breadcrumb.is_active') ? (bool)$request->input('breadcrumb.is_active') : true;
            $sections['breadcrumb'] = $breadcrumb;
        } elseif ($request->has('sections.breadcrumb')) {
            $sections['breadcrumb'] = [
                'title' => $request->input('sections.breadcrumb.title'),
                'background_image' => $request->input('sections.breadcrumb.background_image_existing'),
                'is_active' => $request->has('sections.breadcrumb.is_active') && $request->input('sections.breadcrumb.is_active') == '1',
            ];
        }

        // Handle Services page sections
        if ($pageKey == 'services') {
            // Work Section
            if ($request->has('sections.work_section')) {
                $sections['work_section'] = [
                    'subtitle' => $request->input('sections.work_section.subtitle'),
                    'heading' => $request->input('sections.work_section.heading'),
                    'background_image' => $request->input('sections.work_section.background_image_existing'),
                    'steps' => $request->input('sections.work_section.steps', []),
                    'is_active' => $request->has('sections.work_section.is_active') && $request->input('sections.work_section.is_active') == '1',
                ];
            }

            // Contact Section
            if ($request->has('sections.contact_section')) {
                $contactCards = [];
                $contactSectionData = $request->input('sections.contact_section', []);
                
                // Process contact cards
                if (isset($contactSectionData['contact_cards']) && is_array($contactSectionData['contact_cards'])) {
                    foreach ($contactSectionData['contact_cards'] as $index => $card) {
                        $cardData = [
                            'title' => $card['title'] ?? '',
                            'text' => $card['text'] ?? '',
                            'icon' => $card['icon_existing'] ?? '',
                        ];
                        $contactCards[] = $cardData;
                    }
                }

                $sections['contact_section'] = [
                    'subtitle' => $contactSectionData['subtitle'] ?? '',
                    'heading' => $contactSectionData['heading'] ?? '',
                    'contact_title' => $contactSectionData['contact_title'] ?? '',
                    'contact_description' => $contactSectionData['contact_description'] ?? '',
                    'contact_cards' => $contactCards,
                    'is_active' => $request->has('sections.contact_section.is_active') && $request->input('sections.contact_section.is_active') == '1',
                ];
            }
        }

        // Handle Products page sections
        if ($pageKey == 'products') {
            // Intro Section
            if ($request->has('sections.intro_section')) {
                $sections['intro_section'] = [
                    'subtitle' => $request->input('sections.intro_section.subtitle'),
                    'heading' => $request->input('sections.intro_section.heading'),
                    'description_1' => $request->input('sections.intro_section.description_1'),
                    'description_2' => $request->input('sections.intro_section.description_2'),
                    'image' => $request->input('sections.intro_section.image_existing'),
                    'is_active' => $request->has('sections.intro_section.is_active') && $request->input('sections.intro_section.is_active') == '1',
                ];
            }

            // Categories Section
            if ($request->has('sections.categories_section')) {
                $sections['categories_section'] = [
                    'subtitle' => $request->input('sections.categories_section.subtitle'),
                    'heading' => $request->input('sections.categories_section.heading'),
                    'description' => $request->input('sections.categories_section.description'),
                    'categories' => $request->input('sections.categories_section.categories', []),
                    'is_active' => $request->has('sections.categories_section.is_active') && $request->input('sections.categories_section.is_active') == '1',
                ];
            }

            // Why Choose Section
            if ($request->has('sections.why_choose_section')) {
                $sections['why_choose_section'] = [
                    'subtitle' => $request->input('sections.why_choose_section.subtitle'),
                    'heading' => $request->input('sections.why_choose_section.heading'),
                    'description' => $request->input('sections.why_choose_section.description'),
                    'background_image' => $request->input('sections.why_choose_section.background_image_existing'),
                    'features' => $request->input('sections.why_choose_section.features', []),
                    'is_active' => $request->has('sections.why_choose_section.is_active') && $request->input('sections.why_choose_section.is_active') == '1',
                ];
            }

            // Quality Section
            if ($request->has('sections.quality_section')) {
                $sections['quality_section'] = [
                    'subtitle' => $request->input('sections.quality_section.subtitle'),
                    'heading' => $request->input('sections.quality_section.heading'),
                    'description_1' => $request->input('sections.quality_section.description_1'),
                    'description_2' => $request->input('sections.quality_section.description_2'),
                    'image' => $request->input('sections.quality_section.image_existing'),
                    'quality_boxes' => $request->input('sections.quality_section.quality_boxes', []),
                    'is_active' => $request->has('sections.quality_section.is_active') && $request->input('sections.quality_section.is_active') == '1',
                ];
            }
        }

        // Handle Blog page sections
        if ($pageKey == 'blog') {
            if ($request->has('sections.blog_section')) {
                $sections['blog_section'] = [
                    'subtitle' => $request->input('sections.blog_section.subtitle'),
                    'heading' => $request->input('sections.blog_section.heading'),
                    'description' => $request->input('sections.blog_section.description'),
                    'is_active' => $request->has('sections.blog_section.is_active') && $request->input('sections.blog_section.is_active') == '1',
                ];
            }
        }

        return $sections;
    }

    /**
     * Handle image uploads
     */
    private function handleImages(Request $request, Page $page, array &$data, $pageKey)
    {
        // Handle breadcrumb background image
        if ($request->hasFile('breadcrumb.background_image')) {
            $path = ImageService::uploadAndConvert($request->file('breadcrumb.background_image'), 'pages/' . $pageKey);
            $data['sections']['breadcrumb']['background_image'] = $path;
        } elseif ($request->hasFile('breadcrumb_background_image')) {
            // For services, products, blog, contact pages
            $path = ImageService::uploadAndConvert($request->file('breadcrumb_background_image'), 'pages/' . $pageKey);
            $data['sections']['breadcrumb']['background_image'] = $path;
        } elseif ($request->has('sections.breadcrumb.background_image_existing')) {
            $data['sections']['breadcrumb']['background_image'] = $request->input('sections.breadcrumb.background_image_existing');
        }

        // Handle About page images
        if ($pageKey == 'about') {
            $this->handleAboutImages($request, $data);
        }

        // Handle Contact page images
        if ($pageKey == 'contact') {
            $this->handleContactImages($request, $data, $pageKey);
        }

        // Handle Services page images
        if ($pageKey == 'services') {
            $this->handleServicesImages($request, $data);
        }
        
        // Handle Products page images
        if ($pageKey == 'products') {
            $this->handleProductsImages($request, $data);
        }
        
        // Contact section image handling is already done in handleContactImages
    }

    /**
     * Handle About page specific images
     */
    private function handleAboutImages(Request $request, array &$data)
    {
        // About section images
        if ($request->hasFile('about_section.image_1')) {
            $data['sections']['about_section']['image_1'] = ImageService::uploadAndConvert(
                $request->file('about_section.image_1'), 
                'pages/about'
            );
        }
        if ($request->hasFile('about_section.image_2')) {
            $data['sections']['about_section']['image_2'] = ImageService::uploadAndConvert(
                $request->file('about_section.image_2'), 
                'pages/about'
            );
        }

        // Choose section image
        if ($request->hasFile('choose_section.image')) {
            $data['sections']['choose_section']['image'] = ImageService::uploadAndConvert(
                $request->file('choose_section.image'), 
                'pages/about'
            );
        }

        // Value section image
        if ($request->hasFile('value_section.image')) {
            $data['sections']['value_section']['image'] = ImageService::uploadAndConvert(
                $request->file('value_section.image'), 
                'pages/about'
            );
        }

        // Testimonial images
        if ($request->has('testimonial_section.testimonials')) {
            foreach ($request->input('testimonial_section.testimonials', []) as $index => $testimonial) {
                if ($request->hasFile("testimonial_section.testimonials.{$index}.image")) {
                    $data['sections']['testimonial_section']['testimonials'][$index]['image'] = ImageService::uploadAndConvert(
                        $request->file("testimonial_section.testimonials.{$index}.image"), 
                        'pages/about/testimonials'
                    );
                }
            }
        }

        // Team member images
        if ($request->has('team_section.members')) {
            foreach ($request->input('team_section.members', []) as $index => $member) {
                if ($request->hasFile("team_section.members.{$index}.image")) {
                    $data['sections']['team_section']['members'][$index]['image'] = ImageService::uploadAndConvert(
                        $request->file("team_section.members.{$index}.image"), 
                        'pages/about/team'
                    );
                }
            }
        }
    }

    /**
     * Handle Contact page specific images
     */
    private function handleContactImages(Request $request, array &$data, $pageKey)
    {
        // Contact section image
        if ($request->hasFile('contact_section.image')) {
            $data['sections']['contact_section']['image'] = ImageService::uploadAndConvert(
                $request->file('contact_section.image'), 
                'pages/contact'
            );
        } elseif ($request->hasFile('contact_section_image')) {
            $data['sections']['contact_section']['image'] = ImageService::uploadAndConvert(
                $request->file('contact_section_image'), 
                'pages/contact'
            );
        } elseif ($request->has('sections.contact_section.image_existing')) {
            $data['sections']['contact_section']['image'] = $request->input('sections.contact_section.image_existing');
        }
        
        // Contact cards images
        if ($request->has('sections.contact_cards')) {
            $contactCards = $request->input('sections.contact_cards', []);
            foreach ($contactCards as $index => $card) {
                // Handle icon upload
                if ($request->hasFile("contact_card_{$index}_icon") && 
                    ($card['icon_type'] ?? '') != 'whatsapp') {
                    // Update the icon in the processed sections
                    if (!isset($data['sections']['contact_cards'])) {
                        $data['sections']['contact_cards'] = [];
                    }
                    if (!isset($data['sections']['contact_cards'][$index])) {
                        $data['sections']['contact_cards'][$index] = [];
                    }
                    $data['sections']['contact_cards'][$index]['icon'] = ImageService::uploadAndConvert(
                        $request->file("contact_card_{$index}_icon"), 
                        'pages/contact/cards'
                    );
                } elseif (isset($card['icon_existing']) && ($card['icon_type'] ?? '') != 'whatsapp') {
                    // Keep existing icon if no new upload
                    if (!isset($data['sections']['contact_cards'])) {
                        $data['sections']['contact_cards'] = [];
                    }
                    if (!isset($data['sections']['contact_cards'][$index])) {
                        $data['sections']['contact_cards'][$index] = [];
                    }
                    $data['sections']['contact_cards'][$index]['icon'] = $card['icon_existing'];
                }
            }
        }
    }
    
    /**
     * Handle Products page specific images
     */
    private function handleProductsImages(Request $request, array &$data)
    {
        // Intro section main image
        if ($request->hasFile('intro_section_image')) {
            if (!isset($data['sections']['intro_section'])) {
                $data['sections']['intro_section'] = [];
            }
            $data['sections']['intro_section']['image'] = ImageService::uploadAndConvert(
                $request->file('intro_section_image'),
                'pages/products/intro'
            );
        } elseif ($request->has('sections.intro_section.image_existing')) {
            if (!isset($data['sections']['intro_section'])) {
                $data['sections']['intro_section'] = [];
            }
            $data['sections']['intro_section']['image'] = $request->input('sections.intro_section.image_existing');
        }

        // Categories icons
        if ($request->has('sections.categories_section.categories')) {
            $categories = $request->input('sections.categories_section.categories', []);
            foreach ($categories as $index => $category) {
                // New icon upload
                if ($request->hasFile("category_{$index}_icon")) {
                    if (!isset($data['sections']['categories_section']['categories'])) {
                        $data['sections']['categories_section']['categories'] = [];
                    }
                    if (!isset($data['sections']['categories_section']['categories'][$index])) {
                        $data['sections']['categories_section']['categories'][$index] = [];
                    }
                    $data['sections']['categories_section']['categories'][$index]['icon'] = ImageService::uploadAndConvert(
                        $request->file("category_{$index}_icon"),
                        'pages/products/categories'
                    );
                } elseif (isset($category['icon_existing'])) {
                    // Keep existing icon if no new upload
                    if (!isset($data['sections']['categories_section']['categories'])) {
                        $data['sections']['categories_section']['categories'] = [];
                    }
                    if (!isset($data['sections']['categories_section']['categories'][$index])) {
                        $data['sections']['categories_section']['categories'][$index] = [];
                    }
                    $data['sections']['categories_section']['categories'][$index]['icon'] = $category['icon_existing'];
                }
            }
        }

        // Why choose section background image
        if ($request->hasFile('why_choose_section_background_image')) {
            if (!isset($data['sections']['why_choose_section'])) {
                $data['sections']['why_choose_section'] = [];
            }
            $data['sections']['why_choose_section']['background_image'] = ImageService::uploadAndConvert(
                $request->file('why_choose_section_background_image'),
                'pages/products/why-choose'
            );
        } elseif ($request->has('sections.why_choose_section.background_image_existing')) {
            if (!isset($data['sections']['why_choose_section'])) {
                $data['sections']['why_choose_section'] = [];
            }
            $data['sections']['why_choose_section']['background_image'] = $request->input('sections.why_choose_section.background_image_existing');
        }

        // Quality section image
        if ($request->hasFile('quality_section_image')) {
            if (!isset($data['sections']['quality_section'])) {
                $data['sections']['quality_section'] = [];
            }
            $data['sections']['quality_section']['image'] = ImageService::uploadAndConvert(
                $request->file('quality_section_image'),
                'pages/products/quality'
            );
        } elseif ($request->has('sections.quality_section.image_existing')) {
            if (!isset($data['sections']['quality_section'])) {
                $data['sections']['quality_section'] = [];
            }
            $data['sections']['quality_section']['image'] = $request->input('sections.quality_section.image_existing');
        }
    }

    /**
     * Handle Services page specific images
     */
    private function handleServicesImages(Request $request, array &$data)
    {
        // Work section background image
        if ($request->hasFile('work_section_background_image')) {
            $data['sections']['work_section']['background_image'] = ImageService::uploadAndConvert(
                $request->file('work_section_background_image'), 
                'pages/services'
            );
        }

        // Contact cards icons
        if ($request->has('sections.contact_section.contact_cards')) {
            $contactCards = $request->input('sections.contact_section.contact_cards', []);
            foreach ($contactCards as $index => $card) {
                if ($request->hasFile("contact_card_{$index}_icon")) {
                    if (!isset($data['sections']['contact_section']['contact_cards'])) {
                        $data['sections']['contact_section']['contact_cards'] = [];
                    }
                    if (!isset($data['sections']['contact_section']['contact_cards'][$index])) {
                        $data['sections']['contact_section']['contact_cards'][$index] = [];
                    }
                    $data['sections']['contact_section']['contact_cards'][$index]['icon'] = ImageService::uploadAndConvert(
                        $request->file("contact_card_{$index}_icon"), 
                        'pages/services/contact-cards'
                    );
                }
            }
        }
    }
}
