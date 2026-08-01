/**
 * Tracking Helper Script
 * Automatically tracks CTA clicks on the website
 */

(function() {
    'use strict';

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    }

    function toFormData(payload) {
        const formData = new FormData();
        Object.entries(payload).forEach(([key, value]) => {
            if (value !== undefined && value !== null) {
                formData.append(key, value);
            }
        });
        return formData;
    }

    function sendTracking(url, payload) {
        const csrfToken = getCsrfToken();
        if (!csrfToken) {
            return Promise.resolve(false);
        }

        const requestPayload = {
            ...payload,
            _token: csrfToken,
        };

        if (navigator.sendBeacon) {
            const success = navigator.sendBeacon(url, toFormData(requestPayload));
            if (success) {
                return Promise.resolve(true);
            }
        }

        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            credentials: 'same-origin',
            keepalive: true,
            body: JSON.stringify(requestPayload),
        }).then(() => true).catch((err) => {
            console.warn('Tracking request failed:', err);
            return false;
        });
    }

    // Track CTA click
    function trackCtaClick(ctaType, ctaLabel, ctaUrl, pagePath) {
        return sendTracking('/api/track/cta', {
            cta_type: ctaType,
            cta_label: ctaLabel || null,
            cta_url: ctaUrl || null,
            page_path: pagePath || window.location.pathname,
        });
    }

    // Track blog view
    function trackBlogView(blogId) {
        return sendTracking(`/api/track/blog/${blogId}`, {});
    }

    // Auto-track CTA clicks with event delegation
    document.addEventListener('click', function(event) {
        const trackedElement = event.target.closest('[data-track-cta]');
        if (trackedElement) {
            const ctaType = trackedElement.getAttribute('data-track-cta');
            const ctaLabel = trackedElement.getAttribute('data-track-label') || trackedElement.textContent.trim();
            const ctaUrl = trackedElement.getAttribute('href') || trackedElement.getAttribute('data-track-url');
            trackCtaClick(ctaType, ctaLabel, ctaUrl);
            return;
        }

        const link = event.target.closest('a');
        if (!link) {
            return;
        }

        if (link.matches('a[href*="wa.me"], a[href*="whatsapp.com"]')) {
            const ctaLabel = link.textContent.trim() || 'WhatsApp';
            const ctaUrl = link.getAttribute('href');
            trackCtaClick('whatsapp', ctaLabel, ctaUrl);
            return;
        }

        if (link.matches('a[href^="tel:"]')) {
            const ctaLabel = link.textContent.trim() || 'Phone';
            const ctaUrl = link.getAttribute('href');
            trackCtaClick('phone', ctaLabel, ctaUrl);
            return;
        }

        if (link.matches('a[href^="mailto:"]')) {
            const ctaLabel = link.textContent.trim() || 'Email';
            const ctaUrl = link.getAttribute('href');
            trackCtaClick('email', ctaLabel, ctaUrl);
            return;
        }
    });

    // Expose functions globally for manual tracking
    window.trackCtaClick = trackCtaClick;
    window.trackBlogView = trackBlogView;
})();

