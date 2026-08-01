<!--================= Cta section start =================-->
@php
    $cta_enabled = \App\Models\Setting::get('cta_enabled', '1');
    $cta_enabled = $cta_enabled === '1' || $cta_enabled === true || $cta_enabled === 1;
    $cta_title = \App\Models\Setting::get('cta_title', 'Butuh Penawaran?');
    $cta_subtitle = \App\Models\Setting::get('cta_subtitle', 'Hubungi Kami untuk Solusi Terbaik');
    $cta_button_text = \App\Models\Setting::get('cta_button_text', 'Request Penawaran');
    $contact_phone = \App\Models\Setting::get('contact_phone', '031-8559-7449');
    $whatsappLink = formatWhatsApp($contact_phone);
@endphp

@if($cta_enabled)
@php
    $cta_background_image = \App\Models\Setting::get('cta_background_image');
    $cta_bg_url = $cta_background_image ? asset($cta_background_image) : asset("assets/img/barfi/Landscaping/cta/vl-cta-bg-5.1.png");
@endphp
<section class="vl-cta2">
    <div class="container">
        <div class="vl-cta-bg5" style="background-image: url({{ $cta_bg_url }});">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="vl-cta-content-2 vl-cta-content-2-4 mb-30">
                        <!-- section title start -->
                        <div class="vl-section-title vl-section-title-white">
                            <h2 class="title text-effect">{{ $cta_title }}</h2>
                            @if($cta_subtitle)
                            <p class="para pt-16 pb-16" style="color: #fff;">{{ $cta_subtitle }}</p>
                            @endif
                            <!-- cta btn -->
                            <div class="vl-cta-btn5 mt-32">
                                <button type="button" class="vl-primary-btn5 mr-16" data-bs-toggle="modal" data-bs-target="#requestQuoteModal" data-track-cta="modal" data-track-label="{{ $cta_button_text }}"> <span class="arrow1"><i class="fa-regular fa-arrow-right"></i></span> {{ $cta_button_text }} <span class="arrow2"><i class="fa-regular fa-arrow-right"></i></span></button>
                                <a href="{{ $whatsappLink }}" target="_blank" class="cta-phone5" data-track-cta="whatsapp" data-track-label="CTA WhatsApp - {{ $contact_phone }}" data-track-url="{{ $whatsappLink }}"><span class="mr-8"><i class="fa-brands fa-whatsapp" style="color: #25D366; font-size: 20px;"></i></span>{{ $contact_phone }}</a>
                            </div>
                        </div><!-- section title end -->
                    </div>
                </div>
                <div class="col-xl-1 d-none d-xl-block"></div>
                <div class="col-xl-4 col-lg-4">
                    <div class="vl-cta-phone2 vl-cta-phone2-4 vl-cta-phone2-4-5">
                        <div class="vl-wave-shape pulse-border">
                            <img src="{{ asset("assets/img/barfi/shape/cta-wave-shape2.1.svg") }}" alt="PT. Borneo Iban Jaya Perkasa">
                        </div>
                        <div class="vl-phone-number2 vl-phone-number2-4 vl-phone-number2-4-5">
                            <a href="{{ $whatsappLink }}" target="_blank" data-track-cta="whatsapp" data-track-label="CTA Phone Number - {{ $contact_phone }}" data-track-url="{{ $whatsappLink }}">{{ $contact_phone }}</a>
                        </div>
                        <div class="icon">
                            <span><i class="fa-brands fa-whatsapp" style="color: #25D366; font-size: 48px;"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1"></div>
            </div>
        </div>
    </div>
</section>
<!--================= Cta section End =================-->

<!-- Request Quote Modal -->
<div class="modal fade" id="requestQuoteModal" tabindex="-1" aria-labelledby="requestQuoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
            <div class="modal-header" style="border-bottom: 1px solid #e9ecef; padding: 20px 30px;">
                <h5 class="modal-title" id="requestQuoteModalLabel" style="font-size: 24px; font-weight: 600;">
                    <i class="fa-brands fa-whatsapp" style="color: #25D366; margin-right: 10px;"></i>
                    Request Penawaran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form id="requestQuoteForm">
                    <div class="mb-3">
                        <label for="quoteName" class="form-label" style="font-weight: 500; margin-bottom: 8px;">Nama Lengkap <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="quoteName" name="name" required placeholder="Masukkan nama lengkap Anda" style="border-radius: 8px; padding: 12px; border: 1px solid #ddd;">
                    </div>
                    <div class="mb-3">
                        <label for="quotePhone" class="form-label" style="font-weight: 500; margin-bottom: 8px;">Nomor WhatsApp <span style="color: red;">*</span></label>
                        <input type="tel" class="form-control" id="quotePhone" name="phone" required placeholder="08xxxxxxxxxx" style="border-radius: 8px; padding: 12px; border: 1px solid #ddd;">
                    </div>
                    <div class="mb-3">
                        <label for="quoteEmail" class="form-label" style="font-weight: 500; margin-bottom: 8px;">Email</label>
                        <input type="email" class="form-control" id="quoteEmail" name="email" placeholder="nama@email.com" style="border-radius: 8px; padding: 12px; border: 1px solid #ddd;">
                    </div>
                    <div class="mb-3">
                        <label for="quoteService" class="form-label" style="font-weight: 500; margin-bottom: 8px;">Layanan yang Dibutuhkan</label>
                        <select class="form-control" id="quoteService" name="service" style="border-radius: 8px; padding: 12px; border: 1px solid #ddd;">
                            <option value="">Pilih Layanan</option>
                            <option value="Jasa Bubut">Jasa Bubut</option>
                            <option value="Jasa Stamping">Jasa Stamping</option>
                            <option value="Jasa Moulding">Jasa Moulding</option>
                            <option value="Sparepart">Sparepart</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quoteMessage" class="form-label" style="font-weight: 500; margin-bottom: 8px;">Pesan / Keterangan</label>
                        <textarea class="form-control" id="quoteMessage" name="message" rows="4" placeholder="Jelaskan kebutuhan Anda secara detail..." style="border-radius: 8px; padding: 12px; border: 1px solid #ddd; resize: vertical;"></textarea>
                    </div>
                    <div class="alert alert-info" style="border-radius: 8px; padding: 12px; margin-bottom: 20px; background-color: #e7f3ff; border: 1px solid #b3d9ff;">
                        <i class="fa-solid fa-info-circle" style="margin-right: 8px;"></i>
                        <small>Form ini akan dikirim melalui WhatsApp. Pastikan nomor WhatsApp Anda aktif.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 20px 30px;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px; padding: 10px 20px;">Batal</button>
                <button type="button" class="btn btn-success" id="submitQuoteBtn" style="border-radius: 8px; padding: 10px 30px; background-color: #25D366; border: none;">
                    <i class="fa-brands fa-whatsapp" style="margin-right: 8px;"></i>
                    Kirim ke WhatsApp
                </button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
(function() {
    // Tunggu sampai semua script dimuat
    function initQuoteModal() {
        if (typeof bootstrap === 'undefined' || typeof bootstrap.Modal === 'undefined') {
            setTimeout(initQuoteModal, 100);
            return;
        }
        
        const form = document.getElementById('requestQuoteForm');
        const submitBtn = document.getElementById('submitQuoteBtn');
        const modalElement = document.getElementById('requestQuoteModal');
        
        if (!form || !submitBtn || !modalElement) {
            return;
        }
        
        const modal = new bootstrap.Modal(modalElement);
        
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Validasi form
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            
            // Ambil data form
            const formData = new FormData(form);
            const name = formData.get('name');
            const phone = formData.get('phone');
            const email = formData.get('email');
            const service = formData.get('service');
            const message = formData.get('message');
            
            // Format nomor telepon perusahaan untuk WhatsApp (dari setting)
            @php
                $companyPhone = \App\Models\Setting::get('contact_phone', '031-8559-7449');
                $companyWhatsApp = formatWhatsApp($companyPhone);
                // Extract phone number from WhatsApp link
                $companyPhoneNumber = str_replace('https://wa.me/', '', $companyWhatsApp);
            @endphp
            const companyWhatsApp = '{{ $companyPhoneNumber }}';
            
            // Format pesan untuk WhatsApp
            let whatsappMessage = `*Request Penawaran*\n\n`;
            whatsappMessage += `*Nama:* ${name}\n`;
            whatsappMessage += `*Nomor WhatsApp:* ${phone}\n`;
            if (email) {
                whatsappMessage += `*Email:* ${email}\n`;
            }
            if (service) {
                whatsappMessage += `*Layanan:* ${service}\n`;
            }
            if (message) {
                whatsappMessage += `*Pesan:*\n${message}\n`;
            }
            whatsappMessage += `\n---\n_Pesan ini dikirim melalui website_`;
            
            // Encode pesan untuk URL
            const encodedMessage = encodeURIComponent(whatsappMessage);
            
            // Buka WhatsApp dengan nomor perusahaan
            const whatsappUrl = `https://wa.me/${companyWhatsApp}?text=${encodedMessage}`;
            window.open(whatsappUrl, '_blank');
            
            // Reset form dan tutup modal
            form.reset();
            modal.hide();
        });
        
        // Reset form saat modal ditutup
        modalElement.addEventListener('hidden.bs.modal', function() {
            form.reset();
        });
    }
    
    // Inisialisasi saat DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initQuoteModal);
    } else {
        initQuoteModal();
    }
})();
</script>
@endpush
@endif

