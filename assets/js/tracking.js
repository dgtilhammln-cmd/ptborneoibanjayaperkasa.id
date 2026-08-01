/**
 * Tracking Helper Script
 * Automatically tracks CTA clicks on the website
 */

(function() {
    'use strict';

    // Track CTA click
    function trackCtaClick(ctaType, ctaLabel, ctaUrl, pagePath) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        if (!csrfToken) {
            console.warn('CSRF token not found');
            return;
        }

        fetch('/api/track/cta', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                cta_type: ctaType,
                cta_label: ctaLabel || null,
                cta_url: ctaUrl || null,
                page_path: pagePath || window.location.pathname
            })
        }).catch(err => {
            console.warn('Failed to track CTA click:', err);
        });
    }

    // Track blog view
    function trackBlogView(blogId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        if (!csrfToken) {
            console.warn('CSRF token not found');
            return;
        }

        fetch(`/api/track/blog/${blogId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        }).catch(err => {
            console.warn('Failed to track blog view:', err);
        });
    }

    // Auto-track CTA clicks with data-track attributes
    document.addEventListener('DOMContentLoaded', function() {
        // Track links with data-track-cta attribute
        document.querySelectorAll('[data-track-cta]').forEach(function(element) {
            element.addEventListener('click', function(e) {
                const ctaType = element.getAttribute('data-track-cta');
                const ctaLabel = element.getAttribute('data-track-label') || element.textContent.trim();
                const ctaUrl = element.getAttribute('href') || element.getAttribute('data-track-url');
                
                trackCtaClick(ctaType, ctaLabel, ctaUrl);
            });
        });

        // Auto-detect WhatsApp links
        document.querySelectorAll('a[href*="wa.me"], a[href*="whatsapp.com"]').forEach(function(element) {
            if (!element.hasAttribute('data-track-cta')) {
                element.addEventListener('click', function(e) {
                    const ctaLabel = element.textContent.trim() || 'WhatsApp';
                    const ctaUrl = element.getAttribute('href');
                    trackCtaClick('whatsapp', ctaLabel, ctaUrl);
                });
            }
        });

        // Auto-detect phone links
        document.querySelectorAll('a[href^="tel:"]').forEach(function(element) {
            if (!element.hasAttribute('data-track-cta')) {
                element.addEventListener('click', function(e) {
                    const ctaLabel = element.textContent.trim() || 'Phone';
                    const ctaUrl = element.getAttribute('href');
                    trackCtaClick('phone', ctaLabel, ctaUrl);
                });
            }
        });

        // Auto-detect email links
        document.querySelectorAll('a[href^="mailto:"]').forEach(function(element) {
            if (!element.hasAttribute('data-track-cta')) {
                element.addEventListener('click', function(e) {
                    const ctaLabel = element.textContent.trim() || 'Email';
                    const ctaUrl = element.getAttribute('href');
                    trackCtaClick('email', ctaLabel, ctaUrl);
                });
            }
        });
    });

    // Expose functions globally for manual tracking
    window.trackCtaClick = trackCtaClick;
    window.trackBlogView = trackBlogView;
})();

