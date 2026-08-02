<style>
/* Premium WhatsApp Leads Button & Modal */
.floating-wa-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #128C7E 0%, #075E54 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 34px;
    box-shadow: 0 10px 25px rgba(18, 140, 126, 0.4);
    z-index: 9999;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
    text-decoration: none;
}

.floating-wa-btn:hover {
    transform: scale(1.1) translateY(-5px);
    box-shadow: 0 15px 35px rgba(18, 140, 126, 0.6);
    color: #fff;
}

.floating-wa-btn::before, .floating-wa-btn::after {
    content: '';
    position: absolute;
    border: 2px solid #25D366;
    border-radius: 50%;
    width: 100%;
    height: 100%;
    animation: waPulse 2s infinite;
    z-index: -1;
}
.floating-wa-btn::after {
    animation-delay: 1s;
}

@@keyframes waPulse {
    0% { transform: scale(1); opacity: 0.8; }
    100% { transform: scale(1.6); opacity: 0; }
}

/* Premium Modal Styling */
#waLeadModal .modal-content {
    font-family: 'Plus Jakarta Sans', 'Montserrat', sans-serif !important;
    border: none;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 30px 60px rgba(0,0,0,0.12);
}

#waLeadModal .modal-header {
    background: {{ \App\Models\Setting::get('footer_background_color', '#1a1a1a') }}; /* Match footer color */
    color: {{ \App\Models\Setting::get('footer_text_color', '#ffffff') }};
    border-bottom: none;
    padding: 32px 32px 24px;
    position: relative;
    border-top-left-radius: 24px;
    border-top-right-radius: 24px;
}

#waLeadModal .modal-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 400;
    font-size: 24px;
    color: #ffffff !important;
    letter-spacing: 0px;
    margin-bottom: 4px;
}

#waLeadModal .modal-header p {
    color: #ffffff !important;
    opacity: 0.9;
    font-family: 'Montserrat', sans-serif;
    font-weight: 300;
}

#waLeadModal .modal-header::after {
    content: '\f232'; /* WhatsApp Icon Unicode */
    font-family: 'Font Awesome 6 Brands';
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%) rotate(-10deg);
    font-size: 80px;
    opacity: 0.05;
    color: #fff;
    pointer-events: none;
}

#waLeadModal .btn-close {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: rgba(255,255,255,0.1);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e");
    opacity: 1;
    border-radius: 50%;
    padding: 12px;
    box-shadow: none;
    transition: all 0.2s;
}
#waLeadModal .btn-close:hover {
    background-color: rgba(255,255,255,0.2);
    transform: rotate(90deg);
}

#waLeadModal .modal-body {
    padding: 32px;
    background: #ffffff;
}

#waLeadModal .form-label {
    font-weight: 700;
    color: #334155;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    display: block;
}

#waLeadModal .form-control {
    border-radius: 12px;
    border: 1.5px solid #e2e8f0;
    padding: 14px 18px;
    font-size: 15px;
    font-weight: 500;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #0f172a;
    transition: all 0.3s ease;
    background: #f8fafc;
}
#waLeadModal .form-control::placeholder {
    color: #94a3b8;
    font-weight: 400;
}
#waLeadModal .form-control:focus {
    border-color: #3b82f6;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
    outline: none;
}

#waLeadModal .btn-submit {
    background: #10b981;
    border: none;
    border-radius: 14px;
    color: white;
    font-weight: 800;
    font-size: 16px;
    padding: 18px 24px;
    width: 100%;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-top: 10px;
    box-shadow: 0 4px 14px rgba(16,185,129,0.3);
}

#waLeadModal .btn-submit:hover {
    transform: translateY(-2px);
    background: #059669;
    box-shadow: 0 8px 20px rgba(16,185,129,0.4);
}

#waLeadModal .btn-submit i {
    font-size: 20px;
}

/* Mobile Friendly Adjustments */
@@media (max-width: 768px) {
    .floating-wa-btn {
        bottom: 20px;
        right: 20px;
        width: 55px;
        height: 55px;
        font-size: 30px;
    }
    #waLeadModal .modal-body {
        padding: 24px;
    }
    #waLeadModal .modal-header {
        padding: 24px 24px 20px;
    }
}
</style>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/6281259896884?text={{ urlencode('Halo PT. Borneo Iban Jaya Perkasa, saya tertarik dengan layanan/produk Anda.') }}" class="floating-wa-btn" id="floatingWaBtn" title="Hubungi Kami via WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<!-- WhatsApp Lead Form Modal -->
<div class="modal fade" id="waLeadModal" tabindex="-1" aria-labelledby="waLeadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div>
                    <h5 class="modal-title" id="waLeadModalLabel">Konsultasi WhatsApp</h5>
                    <p class="mb-0 mt-1" style="font-size: 14px; font-weight: 500; opacity: 0.85;">Silakan lengkapi data berikut untuk terhubung dengan tim kami.</p>
                </div>
            </div>
            <div class="modal-body">
                <form id="waLeadForm">
                    <input type="hidden" id="waTargetUrl" name="target_url">
                    <div class="mb-3">
                        <label for="leadName" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="leadName" name="name" required placeholder="Contoh: Budi Santoso">
                    </div>
                    <div class="mb-3">
                        <label for="leadWa" class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="leadWa" name="whatsapp_number" required placeholder="Contoh: 08123456789">
                    </div>
                    <div class="mb-3">
                        <label for="leadCompany" class="form-label">Perusahaan & Lokasi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="leadCompany" name="company_location" required placeholder="Contoh: PT. Maju Jaya - Surabaya">
                    </div>
                    <div class="mb-4">
                        <label for="leadReq" class="form-label">Kebutuhan / Pesan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="leadReq" name="requirements" rows="3" required placeholder="Deskripsikan kebutuhan jasa/produk Anda..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit" id="btnWaSubmit">
                        <span class="btn-text">Lanjutkan ke WhatsApp</span>
                        <i class="fa-brands fa-whatsapp"></i>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="waSpinner"></span>
                    </button>
                    <p class="text-center mt-3 mb-0 text-muted" style="font-size: 11px;">
                        <i class="fa-solid fa-lock me-1"></i> Data Anda dienkripsi dan aman.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Utility to get URL parameters (UTM)
    function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Intercept all WhatsApp links dynamically
    document.body.addEventListener('click', function(e) {
        // Find closest anchor tag
        const link = e.target.closest('a');
        if (!link) return;

        const href = link.getAttribute('href');
        if (href && (href.includes('wa.me') || href.includes('api.whatsapp.com'))) {
            e.preventDefault();
            
            // Show modal
            const waModal = new bootstrap.Modal(document.getElementById('waLeadModal'));
            document.getElementById('waTargetUrl').value = href;
            waModal.show();
        }
    });

    // Handle Form Submission
    document.getElementById('waLeadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('btnWaSubmit');
        const spinner = document.getElementById('waSpinner');
        const btnText = btn.querySelector('.btn-text');
        
        // UI Loading State
        btn.disabled = true;
        btnText.textContent = 'Memproses...';
        spinner.classList.remove('d-none');
        
        const formData = new FormData(this);
        
        // Add Tracking Data
        formData.append('source_url', window.location.href);
        
        const utmSource = getQueryParam('utm_source');
        const utmMedium = getQueryParam('utm_medium');
        const utmCampaign = getQueryParam('utm_campaign');
        
        if(utmSource) formData.append('utm_source', utmSource);
        if(utmMedium) formData.append('utm_medium', utmMedium);
        if(utmCampaign) formData.append('utm_campaign', utmCampaign);

        fetch('{{ route("api.leads.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                // Formatting message for WhatsApp
                const name = document.getElementById('leadName').value;
                const company = document.getElementById('leadCompany').value;
                const req = document.getElementById('leadReq').value;
                const customMessage = `Halo PT. Borneo Iban Jaya Perkasa, perkenalkan saya *${name}* dari *${company}*.\n\nSaya mendapatkan info dari website ptborneoibanjayaperkasa.id dan ingin menanyakan/berkonsultasi mengenai:\n"${req}"\n\nMohon info lebih lanjut. Terima kasih.\n\n_(Ref: ${window.location.href})_`;
                
                // Get original target URL
                let targetUrl = document.getElementById('waTargetUrl').value;
                
                // Construct new URL with custom message
                // If it already has text= param, replace it or append. Usually wa.me/number?text=
                try {
                    let urlObj = new URL(targetUrl);
                    urlObj.searchParams.set('text', customMessage);
                    targetUrl = urlObj.toString();
                } catch(err) {
                    // Fallback if URL parsing fails
                    const baseUrl = targetUrl.split('?')[0];
                    targetUrl = `${baseUrl}?text=${encodeURIComponent(customMessage)}`;
                }

                // Redirect to WhatsApp
                window.location.href = targetUrl;
            } else {
                alert('Terjadi kesalahan. Silakan coba lagi.');
                resetBtn();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Fallback directly to WA if error
            window.location.href = document.getElementById('waTargetUrl').value;
        });
        
        function resetBtn() {
            btn.disabled = false;
            btnText.textContent = 'Lanjutkan ke WhatsApp';
            spinner.classList.add('d-none');
        }
    });
});
</script>
