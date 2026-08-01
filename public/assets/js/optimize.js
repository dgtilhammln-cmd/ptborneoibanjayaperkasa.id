/**
 * Performance Optimization Scripts
 */

// Lazy load images that are not in viewport
(function() {
    'use strict';
    
    // Native lazy loading support check
    if ('loading' in HTMLImageElement.prototype) {
        // Browser supports native lazy loading
        const images = document.querySelectorAll('img[data-lazy]');
        images.forEach(function(img) {
            img.src = img.dataset.lazy;
            img.removeAttribute('data-lazy');
        });
    } else {
        // Fallback: Intersection Observer for older browsers
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.lazy;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            document.querySelectorAll('img[data-lazy]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }
    
    // Preload critical resources
    function preloadResource(href, as, crossorigin) {
        const link = document.createElement('link');
        link.rel = 'preload';
        link.href = href;
        link.as = as;
        if (crossorigin) link.crossOrigin = crossorigin;
        document.head.appendChild(link);
    }
    
    // Defer non-critical CSS
    window.addEventListener('load', function() {
        // Load non-critical CSS after page load
        const deferredCSS = [
            // Add any non-critical CSS files here if needed
        ];
        
        deferredCSS.forEach(function(href) {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = href;
            document.head.appendChild(link);
        });
    });
})();

// Optimize font loading
(function() {
    'use strict';
    
    if ('fonts' in document) {
        // Preload critical fonts
        document.fonts.ready.then(function() {
            // Fonts are loaded
            document.documentElement.classList.add('fonts-loaded');
        });
    }
})();

