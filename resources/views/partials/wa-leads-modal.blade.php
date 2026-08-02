<style>
/* Premium WhatsApp Leads Button & Modal */
.floating-wa-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 32px;
    box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
    z-index: 9999;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
    cursor: pointer;
    text-decoration: none;
}

.floating-wa-btn:hover {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 15px 35px rgba(37, 211, 102, 0.5);
    color: white;
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

@keyframes waPulse {
    0% { transform: scale(1); opacity: 0.8; }
    100% { transform: scale(1.6); opacity: 0; }
}

/* Premium Modal Styling */
#waLeadModal .modal-content {
    font-family: 'Montserrat', system-ui, sans-serif !important;
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
}

#waLeadModal .modal-header {
    background: linear-gradient(135deg, #1a3fa8 0%, #2a5ce8 100%);
    color: white;
    border-bottom: none;
    padding: 25px;
    position: relative;
}

#waLeadModal .modal-title {
    font-weight: 700;
    font-size: 22px;
}

#waLeadModal .modal-header::after {
    content: '\f232'; /* WhatsApp Icon Unicode */
    font-family: 'Font Awesome 6 Brands';
    position: absolute;
    right: 25px;
    font-size: 60px;
    opacity: 0.1;
    top: 50%;
    transform: translateY(-50%);
}

#waLeadModal .btn-close {
    background-color: white;
    opacity: 1;
    border-radius: 50%;
    padding: 10px;
    margin: -10px -10px -10px auto;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

#waLeadModal .modal-body {
    padding: 30px;
    background: #f8fafc;
}

#waLeadModal .form-label {
    font-weight: 600;
    color: #334155;
    font-size: 14px;
    margin-bottom: 8px;
}

#waLeadModal .form-control {
    border-radius: 12px;
    border: 1px solid #cbd5e1;
    padding: 12px 16px;
    font-size: 15px;
    font-family: 'Montserrat', sans-serif;
    transition: all 0.3s ease;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
}

#waLeadModal .form-control:focus {
    border-color: #1a3fa8;
    box-shadow: 0 0 0 4px rgba(26,63,168,0.1);
}

#waLeadModal .btn-submit {
    background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
    border: none;
    border-radius: 12px;
    color: white;
    font-weight: 700;
    font-size: 16px;
    padding: 15px 20px;
    width: 100%;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

#waLeadModal .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(37,211,102,0.3);
}

/* Mobile Friendly Adjustments */
@media (max-width: 768px) {
    .floating-wa-btn {
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        font-size: 28px;
    }
    #waLeadModal .modal-body {
        padding: 20px;
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
                <div>
                    <h5 class="modal-title" id="waLeadModalLabel">Mulai Konsultasi</h5>
                    <p class="mb-0 mt-1" style="font-size: 13px; font-weight: 500; opacity: 0.9;">Tim profesional kami siap membantu Anda.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                
                const customMessage = `*Pesan Baru dari Website*\n\n*Nama:* ${name}\n*Perusahaan/Lokasi:* ${company}\n*Kebutuhan:* ${req}\n\n*Catatan Admin:* Pelanggan ini mengakses dari URL: ${window.location.href}`;
                
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
