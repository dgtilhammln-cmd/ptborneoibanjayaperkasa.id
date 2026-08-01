@php
    // Default breadcrumb items
    $breadcrumbs = $breadcrumbs ?? [
        ['name' => 'Home', 'url' => url('/')]
    ];
    
    // Get current page URL for schema
    $currentUrl = url()->current();
    $baseUrl = url('/');
    
    // Ensure all URLs are absolute
    foreach ($breadcrumbs as &$crumb) {
        if (!empty($crumb['url'])) {
            if (!Str::startsWith($crumb['url'], ['http://', 'https://'])) {
                $crumb['url'] = url($crumb['url']);
            }
        } else {
            $crumb['url'] = $currentUrl;
        }
    }
    unset($crumb);
    
    // Build schema data
    $schemaItems = [];
    $totalItems = count($breadcrumbs);
    foreach ($breadcrumbs as $index => $crumb) {
        $isLast = ($index + 1) === $totalItems;
        $schemaItems[] = [
            'position' => $index + 1,
            'name' => $crumb['name'],
            'url' => $isLast ? $currentUrl : ($crumb['url'] ?? $baseUrl)
        ];
    }
@endphp

<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
        @foreach($breadcrumbs as $index => $crumb)
            @php
                $position = $index + 1;
                $isLast = $loop->last;
                $itemUrl = $isLast ? $currentUrl : ($crumb['url'] ?? $baseUrl);
            @endphp
            <li class="breadcrumb-item {{ $isLast ? 'active' : '' }}" 
                itemprop="itemListElement" 
                itemscope 
                itemtype="https://schema.org/ListItem">
                @if($isLast)
                    <span itemprop="name">{{ $crumb['name'] }}</span>
                    <meta itemprop="position" content="{{ $position }}" />
                @else
                    <a href="{{ $itemUrl }}" itemprop="item">
                        <span itemprop="name">{{ $crumb['name'] }}</span>
                    </a>
                    <meta itemprop="position" content="{{ $position }}" />
                @endif
            </li>
        @endforeach
    </ol>
</nav>

@php
    $schemaJson = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array_map(function($item) {
            return [
                '@type' => 'ListItem',
                'position' => $item['position'],
                'name' => $item['name'],
                'item' => $item['url']
            ];
        }, $schemaItems)
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($schemaJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

