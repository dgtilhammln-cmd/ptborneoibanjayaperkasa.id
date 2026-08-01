<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Services\ImageService;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $textSettings = [
            'site_name',
            'contact_phone',
            'contact_email',
            'contact_address',
            'seo_meta_title',
            'seo_meta_description',
            'seo_meta_keywords',
            'seo_google_analytics',
            'seo_google_site_verification',
            'seo_custom_head_html',
            'cta_title',
            'cta_subtitle',
            'cta_button_text',
            'cta_modal_title',
            'cta_modal_subtitle',
            'cta_whatsapp_number',
            'cta_whatsapp_message',
            'cta_whatsapp_info',
            'site_description',
            'working_hours_weekday',
            'working_hours_saturday',
            'working_hours_sunday',
            'social_facebook',
            'social_instagram',
            'social_linkedin',
            'social_twitter',
            // Old social links (kept for backward compatibility)
            'site_url',
            'footer_terms_link',
            'footer_privacy_link',
            'footer_background_color',
            'footer_text_color',
            'footer_copyright_text',
            'footer_copyright_link'
        ];

        foreach ($textSettings as $key) {
            if ($request->has($key)) {
                // Determine group based on key
                $group = 'general';
                if (strpos($key, 'social_') === 0 || strpos($key, 'working_hours_') === 0 || strpos($key, 'footer_') === 0 || $key === 'site_description' || $key === 'site_url') {
                    $group = 'footer';
                } elseif (strpos($key, 'home_') === 0) {
                    $group = 'home';
                } elseif (strpos($key, 'seo_') === 0) {
                    $group = 'seo';
                } elseif (strpos($key, 'cta_') === 0) {
                    $group = 'cta';
                }
                
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key), 'type' => 'text', 'group' => $group]
                );
            }
        }
        
        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $logoPath = ImageService::uploadAndConvert($request->file('site_logo'), 'logos');
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $logoPath, 'type' => 'text', 'group' => 'general']
            );
        }
        
        // Handle favicon upload
        if ($request->hasFile('site_favicon')) {
            $faviconPath = ImageService::uploadAndConvert($request->file('site_favicon'), 'favicons');
            Setting::updateOrCreate(
                ['key' => 'site_favicon'],
                ['value' => $faviconPath, 'type' => 'text', 'group' => 'general']
            );
        }
        
        // Handle OG image upload
        if ($request->hasFile('seo_og_image')) {
            $ogImagePath = ImageService::uploadAndConvert($request->file('seo_og_image'), 'seo');
            Setting::updateOrCreate(
                ['key' => 'seo_og_image'],
                ['value' => $ogImagePath, 'type' => 'text', 'group' => 'seo']
            );
        }

        // Handle CTA background image upload
        if ($request->hasFile('cta_background_image')) {
            $ctaBgPath = ImageService::uploadAndConvert($request->file('cta_background_image'), 'cta');
            Setting::updateOrCreate(
                ['key' => 'cta_background_image'],
                ['value' => $ctaBgPath, 'type' => 'text', 'group' => 'cta']
            );
        }

        // Handle SEO noindex/nofollow
        if ($request->has('seo_noindex')) {
            Setting::updateOrCreate(
                ['key' => 'seo_noindex'],
                ['value' => $request->input('seo_noindex') ? '1' : '0', 'type' => 'text', 'group' => 'seo']
            );
        } else {
            Setting::updateOrCreate(
                ['key' => 'seo_noindex'],
                ['value' => '0', 'type' => 'text', 'group' => 'seo']
            );
        }

        if ($request->has('seo_nofollow')) {
            Setting::updateOrCreate(
                ['key' => 'seo_nofollow'],
                ['value' => $request->input('seo_nofollow') ? '1' : '0', 'type' => 'text', 'group' => 'seo']
            );
        } else {
            Setting::updateOrCreate(
                ['key' => 'seo_nofollow'],
                ['value' => '0', 'type' => 'text', 'group' => 'seo']
            );
        }

        // Handle CTA enabled/disabled
        if ($request->has('cta_enabled')) {
            Setting::updateOrCreate(
                ['key' => 'cta_enabled'],
                ['value' => $request->input('cta_enabled') ? '1' : '0', 'type' => 'text', 'group' => 'cta']
            );
        }

        // Handle CTA form fields
        if ($request->has('cta_form_fields')) {
            $formFields = json_decode($request->input('cta_form_fields'), true);
            if (is_array($formFields)) {
                Setting::updateOrCreate(
                    ['key' => 'cta_form_fields'],
                    ['value' => json_encode($formFields, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), 'type' => 'json', 'group' => 'cta']
                );
            }
        }

        // Handle dynamic social media links
        if ($request->has('social_links_json')) {
            $socialLinksJson = $request->input('social_links_json');
            if (!empty($socialLinksJson) && $socialLinksJson !== '[]') {
                $socialLinks = json_decode($socialLinksJson, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($socialLinks)) {
                    // Filter out empty links
                    $validLinks = array_filter($socialLinks, function($link) {
                        return !empty($link['label']) && !empty($link['url']);
                    });
                    
                    Setting::updateOrCreate(
                        ['key' => 'social_links'],
                        [
                            'value' => json_encode(array_values($validLinks), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                            'type' => 'json',
                            'group' => 'footer'
                        ]
                    );
                }
            } elseif ($request->has('social_links')) {
                // Handle array format from form
                $socialLinks = $request->input('social_links', []);
                $validLinks = [];
                foreach ($socialLinks as $link) {
                    if (!empty($link['label']) && !empty($link['url'])) {
                        $validLinks[] = [
                            'label' => $link['label'],
                            'url' => $link['url'],
                            'icon' => $link['icon'] ?? 'fa-brands fa-link'
                        ];
                    }
                }
                
                Setting::updateOrCreate(
                    ['key' => 'social_links'],
                    [
                        'value' => json_encode($validLinks, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                        'type' => 'json',
                        'group' => 'footer'
                    ]
                );
            }
        }

        // Handle slider images and text updates
        // Handle slider text updates first (this takes priority if provided)
        if ($request->has('slider_data')) {
            $sliderDataJson = $request->input('slider_data');
            
            // Log for debugging
            \Log::info('Slider data received:', ['raw' => $sliderDataJson, 'empty' => empty($sliderDataJson)]);
            
            if (!empty($sliderDataJson) && $sliderDataJson !== 'null' && $sliderDataJson !== '[]') {
                $sliderData = json_decode($sliderDataJson, true);
                
                if (json_last_error() === JSON_ERROR_NONE && is_array($sliderData)) {
                    // Normalize slider data to ensure all fields are present
                    $normalizedSlides = [];
                    foreach ($sliderData as $slide) {
                        if (!empty($slide['image'])) {
                            $normalizedSlides[] = [
                                'image' => trim($slide['image'] ?? ''),
                                'badge' => trim($slide['badge'] ?? ''),
                                'tagline' => trim($slide['tagline'] ?? ''),
                                'title' => trim($slide['title'] ?? ''),
                                'subtitle' => trim($slide['subtitle'] ?? ($slide['description'] ?? '')),
                                'ctas' => is_array($slide['ctas'] ?? []) ? $slide['ctas'] : []
                            ];
                        }
                    }
                    
                    // Always save, even if empty (to clear old data)
                    Setting::updateOrCreate(
                        ['key' => 'home_slider_images'],
                        [
                            'value' => json_encode($normalizedSlides, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                            'type' => 'json',
                            'group' => 'home'
                        ]
                    );
                    \Log::info('Slider data saved:', ['count' => count($normalizedSlides)]);
                } else {
                    \Log::warning('Slider data JSON decode error:', ['error' => json_last_error_msg(), 'data' => $sliderDataJson]);
                }
            } else {
                \Log::info('Slider data is empty or null, keeping existing data');
                // Don't clear existing data if slider_data is empty/null
            }
        } else {
            // Handle new image uploads only if slider_data not provided
            $existing = Setting::get('home_slider_images', []);
            // Handle new image uploads only if slider_data not provided
            $existingSlides = [];
            foreach ($existing as $item) {
                if (is_string($item)) {
                    $existingSlides[] = [
                        'image' => $item, 
                        'badge' => '',
                        'tagline' => '',
                        'title' => '', 
                        'subtitle' => '', 
                        'ctas' => []
                    ];
                } else {
                    // Normalize old format to new format
                    $slide = [
                        'image' => $item['image'] ?? '',
                        'badge' => $item['badge'] ?? '',
                        'tagline' => $item['tagline'] ?? '',
                        'title' => $item['title'] ?? '',
                        'subtitle' => $item['subtitle'] ?? ($item['description'] ?? ''),
                        'ctas' => $item['ctas'] ?? []
                    ];
                    
                    // Convert old single CTA format to array
                    if (empty($slide['ctas']) && isset($item['cta_title']) && isset($item['cta_url'])) {
                        $slide['ctas'] = [['title' => $item['cta_title'], 'url' => $item['cta_url']]];
                    }
                    
                    $existingSlides[] = $slide;
                }
            }
            
            // Handle new image uploads
            if ($request->hasFile('home_slider_images')) {
                $images = ImageService::uploadMultiple($request->file('home_slider_images'), 'sliders');
                
                // Add new images to existing slides
                foreach ($images as $img) {
                    $existingSlides[] = [
                        'image' => $img, 
                        'badge' => '',
                        'tagline' => '',
                        'title' => '', 
                        'subtitle' => '', 
                        'ctas' => []
                    ];
                }
            }
            
            // Save if we have slides
            if (!empty($existingSlides)) {
                Setting::updateOrCreate(
                    ['key' => 'home_slider_images'],
                    [
                        'value' => json_encode($existingSlides, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                        'type' => 'json',
                        'group' => 'home'
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    /**
     * Delete a slider image
     */
    public function deleteSliderImage(Request $request)
    {
        $imageToDelete = $request->input('image');

        if (!$imageToDelete) {
            return response()->json([
                'success' => false,
                'message' => 'Image path is required.'
            ], 400);
        }

        try {
            // Delete from storage
            ImageService::delete($imageToDelete);

            // Remove from settings
            $slides = Setting::get('home_slider_images', []);
            
            // Handle both old format (string array) and new format (object array)
            $filteredSlides = [];
            foreach ($slides as $slide) {
                if (is_string($slide)) {
                    if ($slide !== $imageToDelete) {
                        $filteredSlides[] = ['image' => $slide, 'title' => '', 'subtitle' => '', 'ctas' => []];
                    }
                } else {
                    if (isset($slide['image']) && $slide['image'] !== $imageToDelete) {
                        // Normalize to new format
                        $normalized = [
                            'image' => $slide['image'] ?? '',
                            'title' => $slide['title'] ?? '',
                            'subtitle' => $slide['subtitle'] ?? ($slide['description'] ?? ''),
                            'ctas' => $slide['ctas'] ?? []
                        ];
                        $filteredSlides[] = $normalized;
                    }
                }
            }
            
            $images = array_values($filteredSlides);

            Setting::updateOrCreate(
                ['key' => 'home_slider_images'],
                ['value' => json_encode($images), 'type' => 'json', 'group' => 'home']
            );

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $e->getMessage()
            ], 500);
        }
    }
}
