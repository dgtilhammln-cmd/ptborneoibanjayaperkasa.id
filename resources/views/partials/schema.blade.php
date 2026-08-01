@php
    $siteName = \App\Models\Setting::get('site_name', 'PT. Borneo Iban Jaya Perkasa');
    $siteUrl = url('/');
    $companyPhone = \App\Models\Setting::get('company_phone', '');
    $companyEmail = \App\Models\Setting::get('company_email', '');
    $companyAddress = \App\Models\Setting::get('company_address', '');
    $companyAbout = \App\Models\Setting::get('company_about', '');
    $logo = \App\Models\Setting::get('site_logo', asset('assets/images/logo.png'));
@endphp

@if($schemaType === 'organization' || $schemaType === 'homepage')
@php
    $organizationSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $siteName,
        'url' => $siteUrl,
        'logo' => asset($logo),
        'sameAs' => array_filter([
            \App\Models\Setting::get('social_facebook'),
            \App\Models\Setting::get('social_instagram'),
            \App\Models\Setting::get('social_linkedin'),
            \App\Models\Setting::get('social_youtube')
        ])
    ];
    if($companyPhone) $organizationSchema['telephone'] = $companyPhone;
    if($companyEmail) $organizationSchema['email'] = $companyEmail;
    if($companyAddress) {
        $organizationSchema['address'] = [
            '@type' => 'PostalAddress',
            'streetAddress' => $companyAddress,
            'addressCountry' => 'ID'
        ];
    }
    if($companyAbout) $organizationSchema['description'] = strip_tags($companyAbout);
@endphp
<script type="application/ld+json">
{!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'website' || $schemaType === 'homepage')
@php
    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $siteName,
        'url' => $siteUrl,
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => $siteUrl . '/search?q={search_term_string}'
            ],
            'query-input' => 'required name=search_term_string'
        ]
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'breadcrumb' && isset($breadcrumbs))
@php
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => []
    ];
    foreach($breadcrumbs as $index => $breadcrumb) {
        $breadcrumbSchema['itemListElement'][] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $breadcrumb['name'],
            'item' => isset($breadcrumb['url']) && $breadcrumb['url'] ? $breadcrumb['url'] : $siteUrl . request()->getPathInfo()
        ];
    }
@endphp
<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'aboutpage' && isset($page))
@php
    $aboutPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'AboutPage',
        'name' => $page->title,
        'description' => strip_tags($page->meta_description ?? $page->content ?? ''),
        'url' => url('/about'),
        'mainEntity' => [
            '@type' => 'Organization',
            'name' => $siteName,
            'url' => $siteUrl,
            'logo' => asset($logo)
        ]
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($aboutPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'product' && isset($product))
@php
    $productSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product->name,
        'description' => strip_tags($product->description ?? ''),
        'image' => asset($product->image),
        'sku' => $product->slug,
        'brand' => [
            '@type' => 'Brand',
            'name' => $siteName
        ]
    ];
    if($product->price) {
        $productSchema['offers'] = [
            '@type' => 'Offer',
            'url' => url('/product/' . $product->slug),
            'priceCurrency' => 'IDR',
            'price' => $product->price,
            'availability' => 'https://schema.org/InStock',
            'seller' => [
                '@type' => 'Organization',
                'name' => $siteName
            ]
        ];
    }
@endphp
<script type="application/ld+json">
{!! json_encode($productSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'productlist' && isset($products))
@php
    $productListSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'itemListElement' => []
    ];
    foreach($products as $index => $product) {
        $productListSchema['itemListElement'][] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'item' => [
                '@type' => 'Product',
                'name' => $product->name,
                'description' => strip_tags($product->description ?? ''),
                'image' => asset($product->image),
                'url' => url('/product/' . $product->slug)
            ]
        ];
    }
@endphp
<script type="application/ld+json">
{!! json_encode($productListSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'service' && isset($service))
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $service->name,
        'description' => strip_tags($service->description ?? ''),
        'image' => asset($service->image),
        'provider' => [
            '@type' => 'Organization',
            'name' => $siteName,
            'url' => $siteUrl
        ],
        'areaServed' => [
            '@type' => 'Country',
            'name' => 'Indonesia'
        ]
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'servicelist' && isset($services))
@php
    $serviceListSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'itemListElement' => []
    ];
    foreach($services as $index => $service) {
        $serviceListSchema['itemListElement'][] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'item' => [
                '@type' => 'Service',
                'name' => $service->name,
                'description' => strip_tags($service->description ?? ''),
                'image' => asset($service->image),
                'url' => url('/service/' . $service->slug)
            ]
        ];
    }
@endphp
<script type="application/ld+json">
{!! json_encode($serviceListSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'blogposting' && isset($blog))
@php
    $blogPostingSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $blog->title,
        'description' => strip_tags($blog->meta_description ?? $blog->content ?? ''),
        'image' => asset($blog->image),
        'datePublished' => $blog->created_at->toIso8601String(),
        'dateModified' => $blog->updated_at->toIso8601String(),
        'author' => [
            '@type' => 'Organization',
            'name' => $siteName
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => $siteName,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset($logo)
            ]
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => url('/blog/' . $blog->slug)
        ]
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($blogPostingSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'blog' && isset($blogs))
@php
    $blogSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Blog',
        'name' => 'Blog - ' . $siteName,
        'description' => 'Artikel dan berita terbaru dari ' . $siteName,
        'url' => url('/blog'),
        'blogPost' => []
    ];
    foreach($blogs as $blog) {
        $blogSchema['blogPost'][] = [
            '@type' => 'BlogPosting',
            'headline' => $blog->title,
            'description' => strip_tags($blog->meta_description ?? substr($blog->content ?? '', 0, 150)),
            'image' => asset($blog->image),
            'datePublished' => $blog->created_at->toIso8601String(),
            'url' => url('/blog/' . $blog->slug)
        ];
    }
@endphp
<script type="application/ld+json">
{!! json_encode($blogSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'contactpage' && isset($page))
@php
    $contactPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ContactPage',
        'name' => $page->title,
        'description' => strip_tags($page->meta_description ?? $page->content ?? ''),
        'url' => url('/contact'),
        'mainEntity' => [
            '@type' => 'Organization',
            'name' => $siteName,
            'url' => $siteUrl
        ]
    ];
    if($companyPhone) $contactPageSchema['mainEntity']['telephone'] = $companyPhone;
    if($companyEmail) $contactPageSchema['mainEntity']['email'] = $companyEmail;
    if($companyAddress) {
        $contactPageSchema['mainEntity']['address'] = [
            '@type' => 'PostalAddress',
            'streetAddress' => $companyAddress,
            'addressCountry' => 'ID'
        ];
    }
@endphp
<script type="application/ld+json">
{!! json_encode($contactPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if($schemaType === 'webpage' && isset($page))
@php
    $webPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => $page->title,
        'description' => strip_tags($page->meta_description ?? $page->content ?? ''),
        'url' => url('/page/' . $page->slug),
        'datePublished' => $page->created_at->toIso8601String(),
        'dateModified' => $page->updated_at->toIso8601String(),
        'publisher' => [
            '@type' => 'Organization',
            'name' => $siteName,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset($logo)
            ]
        ]
    ];
    if($page->featured_image) {
        $webPageSchema['image'] = asset($page->featured_image);
    }
@endphp
<script type="application/ld+json">
{!! json_encode($webPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif
