@php
    $sections = $page->sections ?? [];
    $breadcrumb = $sections['breadcrumb'] ?? [];
    $contactSection = $sections['contact_section'] ?? [];
    $contactCardsRaw = $sections['contact_cards'] ?? [];
    $contactCards = is_array($contactCardsRaw) ? $contactCardsRaw : [];
@endphp

<!-- Breadcrumb Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Breadcrumb Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[breadcrumb][is_active]" value="1" id="breadcrumb_active" {{ ($breadcrumb['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="breadcrumb_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Title</label>
                <input type="text" name="sections[breadcrumb][title]" 
                    value="{{ old('sections.breadcrumb.title', $breadcrumb['title'] ?? 'Contact Us') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Background Image</label>
                <input type="file" name="breadcrumb_background_image" class="form-control" accept="image/*">
                @if(!empty($breadcrumb['background_image']))
                <div class="mt-2">
                    <img src="{{ asset($breadcrumb['background_image']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="sections[breadcrumb][background_image_existing]" value="{{ $breadcrumb['background_image'] }}">
                </div>
                @else
                <small class="text-muted">Default: assets/img/barfi/shape/breadcrumb-shape.svg</small>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Contact Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[contact_section][is_active]" value="1" id="contact_section_active" {{ ($contactSection['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="contact_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Subtitle</label>
                <input type="text" name="sections[contact_section][subtitle]" 
                    value="{{ old('sections.contact_section.subtitle', $contactSection['subtitle'] ?? 'Contact Us') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Heading</label>
                <input type="text" name="sections[contact_section][heading]" 
                    value="{{ old('sections.contact_section.heading', $contactSection['heading'] ?? 'Connect with Barfi Your Local Snow Experts') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Description</label>
                <textarea name="sections[contact_section][description]" 
                    class="form-control" rows="3">{{ old('sections.contact_section.description', $contactSection['description'] ?? 'Don\'t let winter weather slow you down! Our dedicated snow removal team is ready to keep your home or business safe, clear, & accessible.') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold text-white">Image</label>
                <input type="file" name="contact_section_image" class="form-control" accept="image/*">
                @if(!empty($contactSection['image']))
                <div class="mt-2">
                    <img src="{{ asset($contactSection['image']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="sections[contact_section][image_existing]" value="{{ $contactSection['image'] }}">
                </div>
                @else
                <small class="text-muted">Default: assets/img/barfi/SnowRemovalOne/contact/vl-contact-thumb1.png</small>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold text-white">Form Title</label>
                <input type="text" name="sections[contact_section][form_title]" 
                    value="{{ old('sections.contact_section.form_title', $contactSection['form_title'] ?? 'Get In Touch With Us') }}" 
                    class="form-control">
            </div>
        </div>
    </div>
</div>

<!-- Contact Cards -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Contact Cards</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[contact_cards][is_active]" value="1" id="contact_cards_active" {{ (isset($sections['contact_cards']) && ($sections['contact_cards']['is_active'] ?? true)) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="contact_cards_active">Aktif</label>
            </div>
        </div>
        <div id="contactCardsContainer">
            @php
                $defaultCards = [
                    ['icon' => 'assets/img/barfi/icon/vl-contact-icon1.1.svg', 'icon_type' => 'image', 'title' => 'Email Address', 'content' => ['Barfi@gmail.com', 'lorri73@gmail.com']],
                    ['icon' => 'whatsapp', 'icon_type' => 'whatsapp', 'title' => 'Contact Us', 'content' => ['031-8559-7449']],
                    ['icon' => 'assets/img/barfi/icon/vl-contact-icon1.3.svg', 'icon_type' => 'image', 'title' => 'Head Office:', 'content' => ['657 Twin Lakes Drive, Reno, NV 89523']],
                    ['icon' => 'assets/img/barfi/icon/vl-contact-icon1.4.svg', 'icon_type' => 'image', 'title' => 'Works Time:', 'content' => ['We Are Available 24 Hours A Day, 6 Days A Week']],
                ];
                $contactCards = !empty($contactCards) ? $contactCards : $defaultCards;
                // Filter out non-array items
                $contactCards = array_filter($contactCards, 'is_array');
            @endphp
            @foreach($contactCards as $index => $card)
            <div class="card ag-glass border mb-3 contact-card-item" data-index="{{ $index }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Card {{ (int)$index + 1 }}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-card">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-white fw-bold">Icon Type</label>
                            <select name="sections[contact_cards][{{ $index }}][icon_type]" class="form-select">
                                <option value="image" {{ ($card['icon'] ?? '') != 'whatsapp' ? 'selected' : '' }}>Image</option>
                                <option value="whatsapp" {{ ($card['icon'] ?? '') == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white fw-bold">Icon Image (if type = image)</label>
                            <input type="file" name="contact_card_{{ $index }}_icon" class="form-control" accept="image/*">
                            @if(!empty($card['icon']) && $card['icon'] != 'whatsapp')
                            <div class="mt-2">
                                <img src="{{ asset($card['icon']) }}" class="img-thumbnail" style="max-width: 100px;">
                                <input type="hidden" name="sections[contact_cards][{{ $index }}][icon_existing]" value="{{ $card['icon'] }}">
                            </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white fw-bold">Title</label>
                            <input type="text" name="sections[contact_cards][{{ $index }}][title]" 
                                value="{{ $card['title'] ?? '' }}" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white fw-bold">Content (one per line)</label>
                            <textarea name="sections[contact_cards][{{ $index }}][content_text]" 
                                class="form-control" rows="3">{{ (isset($card['content']) && is_array($card['content'])) ? implode("\n", $card['content']) : (isset($card['content']) ? $card['content'] : '') }}</textarea>
                            <small class="text-muted">Enter each line of content on a new line</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-3">
            <button type="button" class="btn btn-sm btn-primary" id="addCardBtn">
                <i class="mdi mdi-plus me-1"></i> Add Contact Card
            </button>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Google Maps</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[map_section][is_active]" value="1" id="map_section_active" {{ (isset($sections['map_url']) && ($sections['map_section']['is_active'] ?? true)) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="map_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Map Embed URL</label>
                <input type="text" name="sections[map_url]" 
                    value="{{ old('sections.map_url', $sections['map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193596.26002810575!2d-74.14431235114544!3d40.69728463488439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2589a018531e3%3A0xb9df1f7387a94119!2sCentral%20Park!5e0!3m2!1sen!2sbd!4v1762656769779!5m2!1sen!2sbd') }}" 
                    class="form-control" placeholder="https://www.google.com/maps/embed?pb=...">
                <small class="text-muted">Paste the full iframe src URL from Google Maps embed code</small>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let cardIndex = {{ count($contactCards) }};
    
    document.getElementById('addCardBtn')?.addEventListener('click', function() {
        const container = document.getElementById('contactCardsContainer');
        const html = `
            <div class="card ag-glass border mb-3 contact-card-item" data-index="${cardIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Card ${cardIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-card">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-white fw-bold">Icon Type</label>
                            <select name="sections[contact_cards][${cardIndex}][icon_type]" class="form-select">
                                <option value="image">Image</option>
                                <option value="whatsapp">WhatsApp</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white fw-bold">Icon Image (if type = image)</label>
                            <input type="file" name="contact_card_${cardIndex}_icon" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white fw-bold">Title</label>
                            <input type="text" name="sections[contact_cards][${cardIndex}][title]" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white fw-bold">Content (one per line)</label>
                            <textarea name="sections[contact_cards][${cardIndex}][content_text]" class="form-control" rows="3"></textarea>
                            <small class="text-muted">Enter each line of content on a new line</small>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        cardIndex++;
        updateCardNumbers();
    });

    document.addEventListener('click', function(e) {
        const removeBtn = e.target.closest('.remove-card');
        if (removeBtn) {
            removeBtn.closest('.contact-card-item').remove();
            updateCardNumbers();
        }
    });

    function updateCardNumbers() {
        document.querySelectorAll('.contact-card-item').forEach((item, index) => {
            item.querySelector('h6').textContent = `Card ${index + 1}`;
            item.setAttribute('data-index', index);
            item.querySelectorAll('input, select, textarea').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/\[sections\]\[contact_cards\]\[\d+\]/, `[sections][contact_cards][${index}]`));
                }
            });
        });
    }
});
</script>
@endpush

