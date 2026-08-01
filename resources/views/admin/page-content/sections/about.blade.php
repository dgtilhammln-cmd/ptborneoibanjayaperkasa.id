@php
    $sections = $page->sections ?? [];
    $aboutSection = $sections['about_section'] ?? [];
    $factSection = $sections['fact_section'] ?? [];
    $chooseSection = $sections['choose_section'] ?? [];
    $workSection = $sections['work_section'] ?? [];
    $valueSection = $sections['value_section'] ?? [];
    $testimonialSection = $sections['testimonial_section'] ?? [];
    $teamSection = $sections['team_section'] ?? [];
@endphp

<!-- About Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">About Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="about_section[is_active]" value="1" id="about_section_active" {{ ($aboutSection['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="about_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label text-white">Subtitle</label>
                <input type="text" name="about_section[subtitle]" value="{{ $aboutSection['subtitle'] ?? 'About us' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Heading</label>
                <input type="text" name="about_section[heading]" value="{{ $aboutSection['heading'] ?? '' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Description</label>
                <textarea name="about_section[description]" class="form-control" rows="3">{{ $aboutSection['description'] ?? '' }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label text-white">Image 1</label>
                <input type="file" name="about_section[image_1]" class="form-control" accept="image/*">
                @if(!empty($aboutSection['image_1']))
                <div class="mt-2">
                    <img src="{{ asset($aboutSection['image_1']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="about_section[image_1_existing]" value="{{ $aboutSection['image_1'] }}">
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label text-white">Image 2</label>
                <input type="file" name="about_section[image_2]" class="form-control" accept="image/*">
                @if(!empty($aboutSection['image_2']))
                <div class="mt-2">
                    <img src="{{ asset($aboutSection['image_2']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="about_section[image_2_existing]" value="{{ $aboutSection['image_2'] }}">
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label text-white">Counter 1 Number</label>
                <input type="text" name="about_section[counter_1_number]" value="{{ $aboutSection['counter_1_number'] ?? '' }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label text-white">Counter 1 Text</label>
                <input type="text" name="about_section[counter_1_text]" value="{{ $aboutSection['counter_1_text'] ?? '' }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label text-white">Counter 2 Number</label>
                <input type="text" name="about_section[counter_2_number]" value="{{ $aboutSection['counter_2_number'] ?? '' }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label text-white">Counter 2 Text</label>
                <input type="text" name="about_section[counter_2_text]" value="{{ $aboutSection['counter_2_text'] ?? '' }}" class="form-control">
            </div>
        </div>
    </div>
</div>

<!-- Fact Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Fact Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="fact_section[is_active]" value="1" id="fact_section_active" {{ ($factSection['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="fact_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label text-white">Subtitle</label>
                <input type="text" name="fact_section[subtitle]" value="{{ $factSection['subtitle'] ?? 'Interesting Facts' }}" class="form-control">
            </div>
            <div id="factsContainer">
                @foreach(($factSection['facts'] ?? []) as $index => $fact)
                <div class="card ag-glass border mb-3 fact-item" data-index="{{ $index }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 text-white">Fact {{ $index + 1 }}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-fact">Remove</button>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label text-white">Number</label>
                                <input type="text" name="fact_section[facts][{{ $index }}][number]" value="{{ $fact['number'] ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-white">Symbol</label>
                                <input type="text" name="fact_section[facts][{{ $index }}][symbol]" value="{{ $fact['symbol'] ?? '' }}" class="form-control" placeholder="+, %, etc">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-white">Text</label>
                                <input type="text" name="fact_section[facts][{{ $index }}][text]" value="{{ $fact['text'] ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-primary" id="addFactBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Fact
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Choose Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Why Choose Us Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="choose_section[is_active]" value="1" id="choose_section_active" {{ ($chooseSection['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="choose_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label text-white">Subtitle</label>
                <input type="text" name="choose_section[subtitle]" value="{{ $chooseSection['subtitle'] ?? 'Why Choose Us' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Heading</label>
                <input type="text" name="choose_section[heading]" value="{{ $chooseSection['heading'] ?? '' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Description</label>
                <textarea name="choose_section[description]" class="form-control" rows="3">{{ $chooseSection['description'] ?? '' }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label text-white">Image</label>
                <input type="file" name="choose_section[image]" class="form-control" accept="image/*">
                @if(!empty($chooseSection['image']))
                <div class="mt-2">
                    <img src="{{ asset($chooseSection['image']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="choose_section[image_existing]" value="{{ $chooseSection['image'] }}">
                </div>
                @endif
            </div>
            <div id="featuresContainer">
                @foreach(($chooseSection['features'] ?? []) as $index => $feature)
                <div class="card ag-glass border mb-3 feature-item" data-index="{{ $index }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 text-white">Feature {{ $index + 1 }}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-feature">Remove</button>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-white">Icon Image</label>
                                <input type="file" name="choose_section[features][{{ $index }}][icon]" class="form-control" accept="image/*">
                                @if(!empty($feature['icon']))
                                <div class="mt-2">
                                    <img src="{{ asset($feature['icon']) }}" class="img-thumbnail" style="max-width: 100px;">
                                    <input type="hidden" name="choose_section[features][{{ $index }}][icon_existing]" value="{{ $feature['icon'] }}">
                                </div>
                                @endif
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Title</label>
                                <input type="text" name="choose_section[features][{{ $index }}][title]" value="{{ $feature['title'] ?? '' }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Description</label>
                                <textarea name="choose_section[features][{{ $index }}][description]" class="form-control" rows="2">{{ $feature['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-primary" id="addFeatureBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Feature
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Work Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">How It Works Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="work_section[is_active]" value="1" id="work_section_active" {{ ($workSection['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="work_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label text-white">Subtitle</label>
                <input type="text" name="work_section[subtitle]" value="{{ $workSection['subtitle'] ?? 'How It Work' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Heading</label>
                <input type="text" name="work_section[heading]" value="{{ $workSection['heading'] ?? '' }}" class="form-control">
            </div>
            <div id="stepsContainer">
                @foreach(($workSection['steps'] ?? []) as $index => $step)
                <div class="card ag-glass border mb-3 step-item" data-index="{{ $index }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 text-white">Step {{ $index + 1 }}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-step">Remove</button>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label text-white">Number</label>
                                <input type="text" name="work_section[steps][{{ $index }}][number]" value="{{ $step['number'] ?? '' }}" class="form-control" placeholder="01">
                            </div>
                            <div class="col-md-9">
                                <label class="form-label text-white">Title</label>
                                <input type="text" name="work_section[steps][{{ $index }}][title]" value="{{ $step['title'] ?? '' }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Description</label>
                                <textarea name="work_section[steps][{{ $index }}][description]" class="form-control" rows="2">{{ $step['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-primary" id="addStepBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Step
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Value Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Core Values Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="value_section[is_active]" value="1" id="value_section_active" {{ ($valueSection['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="value_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label text-white">Subtitle</label>
                <input type="text" name="value_section[subtitle]" value="{{ $valueSection['subtitle'] ?? 'Our Core Values' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Heading</label>
                <input type="text" name="value_section[heading]" value="{{ $valueSection['heading'] ?? '' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Description</label>
                <textarea name="value_section[description]" class="form-control" rows="3">{{ $valueSection['description'] ?? '' }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label text-white">Image</label>
                <input type="file" name="value_section[image]" class="form-control" accept="image/*">
                @if(!empty($valueSection['image']))
                <div class="mt-2">
                    <img src="{{ asset($valueSection['image']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="value_section[image_existing]" value="{{ $valueSection['image'] }}">
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label text-white">Mission Title</label>
                <input type="text" name="value_section[mission_title]" value="{{ $valueSection['mission_title'] ?? 'Our Mission' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Mission Text</label>
                <textarea name="value_section[mission_text]" class="form-control" rows="2">{{ $valueSection['mission_text'] ?? '' }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label text-white">Vision Title</label>
                <input type="text" name="value_section[vision_title]" value="{{ $valueSection['vision_title'] ?? 'Our Vision' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Vision Text</label>
                <textarea name="value_section[vision_text]" class="form-control" rows="2">{{ $valueSection['vision_text'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
</div>

<!-- Testimonial Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Testimonials Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="testimonial_section[is_active]" value="1" id="testimonial_section_active" {{ ($testimonialSection['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="testimonial_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label text-white">Subtitle</label>
                <input type="text" name="testimonial_section[subtitle]" value="{{ $testimonialSection['subtitle'] ?? 'Testimonials' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Heading</label>
                <input type="text" name="testimonial_section[heading]" value="{{ $testimonialSection['heading'] ?? '' }}" class="form-control">
            </div>
            <div id="testimonialsContainer">
                @foreach(($testimonialSection['testimonials'] ?? []) as $index => $testimonial)
                <div class="card ag-glass border mb-3 testimonial-item" data-index="{{ $index }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 text-white">Testimonial {{ $index + 1 }}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-testimonial">Remove</button>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label text-white">Quote</label>
                                <textarea name="testimonial_section[testimonials][{{ $index }}][quote]" class="form-control" rows="2">{{ $testimonial['quote'] ?? '' }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-white">Author Name</label>
                                <input type="text" name="testimonial_section[testimonials][{{ $index }}][author]" value="{{ $testimonial['author'] ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-white">Position</label>
                                <input type="text" name="testimonial_section[testimonials][{{ $index }}][position]" value="{{ $testimonial['position'] ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-white">Image</label>
                                <input type="file" name="testimonial_section[testimonials][{{ $index }}][image]" class="form-control" accept="image/*">
                                @if(!empty($testimonial['image']))
                                <div class="mt-2">
                                    <img src="{{ asset($testimonial['image']) }}" class="img-thumbnail" style="max-width: 100px;">
                                    <input type="hidden" name="testimonial_section[testimonials][{{ $index }}][image_existing]" value="{{ $testimonial['image'] }}">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-primary" id="addTestimonialBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Testimonial
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Team Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="team_section[is_active]" value="1" id="team_section_active" {{ ($teamSection['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="team_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label text-white">Subtitle</label>
                <input type="text" name="team_section[subtitle]" value="{{ $teamSection['subtitle'] ?? 'Our Team' }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label text-white">Heading</label>
                <input type="text" name="team_section[heading]" value="{{ $teamSection['heading'] ?? '' }}" class="form-control">
            </div>
            <div id="membersContainer">
                @foreach(($teamSection['members'] ?? []) as $index => $member)
                <div class="card ag-glass border mb-3 member-item" data-index="{{ $index }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 text-white">Member {{ $index + 1 }}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-member">Remove</button>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-white">Name</label>
                                <input type="text" name="team_section[members][{{ $index }}][name]" value="{{ $member['name'] ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Position</label>
                                <input type="text" name="team_section[members][{{ $index }}][position]" value="{{ $member['position'] ?? '' }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Image</label>
                                <input type="file" name="team_section[members][{{ $index }}][image]" class="form-control" accept="image/*">
                                @if(!empty($member['image']))
                                <div class="mt-2">
                                    <img src="{{ asset($member['image']) }}" class="img-thumbnail" style="max-width: 150px;">
                                    <input type="hidden" name="team_section[members][{{ $index }}][image_existing]" value="{{ $member['image'] }}">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-primary" id="addMemberBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Member
                </button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Facts
    let factIndex = {{ count($factSection['facts'] ?? []) }};
    document.getElementById('addFactBtn')?.addEventListener('click', function() {
        const container = document.getElementById('factsContainer');
        const html = `
            <div class="card ag-glass border mb-3 fact-item" data-index="${factIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Fact ${factIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-fact">Remove</button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label text-white">Number</label>
                            <input type="text" name="fact_section[facts][${factIndex}][number]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-white">Symbol</label>
                            <input type="text" name="fact_section[facts][${factIndex}][symbol]" class="form-control" placeholder="+, %, etc">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-white">Text</label>
                            <input type="text" name="fact_section[facts][${factIndex}][text]" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        factIndex++;
        updateFactNumbers();
    });

    // Features
    let featureIndex = {{ count($chooseSection['features'] ?? []) }};
    document.getElementById('addFeatureBtn')?.addEventListener('click', function() {
        const container = document.getElementById('featuresContainer');
        const html = `
            <div class="card ag-glass border mb-3 feature-item" data-index="${featureIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Feature ${featureIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-feature">Remove</button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label text-white">Icon Image</label>
                            <input type="file" name="choose_section[features][${featureIndex}][icon]" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white">Title</label>
                            <input type="text" name="choose_section[features][${featureIndex}][title]" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white">Description</label>
                            <textarea name="choose_section[features][${featureIndex}][description]" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        featureIndex++;
        updateFeatureNumbers();
    });

    // Steps
    let stepIndex = {{ count($workSection['steps'] ?? []) }};
    document.getElementById('addStepBtn')?.addEventListener('click', function() {
        const container = document.getElementById('stepsContainer');
        const html = `
            <div class="card ag-glass border mb-3 step-item" data-index="${stepIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Step ${stepIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-step">Remove</button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label text-white">Number</label>
                            <input type="text" name="work_section[steps][${stepIndex}][number]" class="form-control" placeholder="01">
                        </div>
                        <div class="col-md-9">
                            <label class="form-label text-white">Title</label>
                            <input type="text" name="work_section[steps][${stepIndex}][title]" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white">Description</label>
                            <textarea name="work_section[steps][${stepIndex}][description]" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        stepIndex++;
        updateStepNumbers();
    });

    // Testimonials
    let testimonialIndex = {{ count($testimonialSection['testimonials'] ?? []) }};
    document.getElementById('addTestimonialBtn')?.addEventListener('click', function() {
        const container = document.getElementById('testimonialsContainer');
        const html = `
            <div class="card ag-glass border mb-3 testimonial-item" data-index="${testimonialIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Testimonial ${testimonialIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-testimonial">Remove</button>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label text-white">Quote</label>
                            <textarea name="testimonial_section[testimonials][${testimonialIndex}][quote]" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-white">Author Name</label>
                            <input type="text" name="testimonial_section[testimonials][${testimonialIndex}][author]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-white">Position</label>
                            <input type="text" name="testimonial_section[testimonials][${testimonialIndex}][position]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-white">Image</label>
                            <input type="file" name="testimonial_section[testimonials][${testimonialIndex}][image]" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        testimonialIndex++;
        updateTestimonialNumbers();
    });

    // Members
    let memberIndex = {{ count($teamSection['members'] ?? []) }};
    document.getElementById('addMemberBtn')?.addEventListener('click', function() {
        const container = document.getElementById('membersContainer');
        const html = `
            <div class="card ag-glass border mb-3 member-item" data-index="${memberIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Member ${memberIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-member">Remove</button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-white">Name</label>
                            <input type="text" name="team_section[members][${memberIndex}][name]" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white">Position</label>
                            <input type="text" name="team_section[members][${memberIndex}][position]" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white">Image</label>
                            <input type="file" name="team_section[members][${memberIndex}][image]" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        memberIndex++;
        updateMemberNumbers();
    });

    // Remove handlers
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-fact')) {
            e.target.closest('.fact-item').remove();
            updateFactNumbers();
        }
        if (e.target.classList.contains('remove-feature')) {
            e.target.closest('.feature-item').remove();
            updateFeatureNumbers();
        }
        if (e.target.classList.contains('remove-step')) {
            e.target.closest('.step-item').remove();
            updateStepNumbers();
        }
        if (e.target.classList.contains('remove-testimonial')) {
            e.target.closest('.testimonial-item').remove();
            updateTestimonialNumbers();
        }
        if (e.target.classList.contains('remove-member')) {
            e.target.closest('.member-item').remove();
            updateMemberNumbers();
        }
    });

    function updateFactNumbers() {
        document.querySelectorAll('.fact-item').forEach((item, index) => {
            item.querySelector('h6').textContent = `Fact ${index + 1}`;
            item.setAttribute('data-index', index);
            item.querySelectorAll('input, textarea').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/\[facts\]\[\d+\]/, `[facts][${index}]`));
                }
            });
        });
    }

    function updateFeatureNumbers() {
        document.querySelectorAll('.feature-item').forEach((item, index) => {
            item.querySelector('h6').textContent = `Feature ${index + 1}`;
            item.setAttribute('data-index', index);
            item.querySelectorAll('input, textarea').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/\[features\]\[\d+\]/, `[features][${index}]`));
                }
            });
        });
    }

    function updateStepNumbers() {
        document.querySelectorAll('.step-item').forEach((item, index) => {
            item.querySelector('h6').textContent = `Step ${index + 1}`;
            item.setAttribute('data-index', index);
            item.querySelectorAll('input, textarea').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/\[steps\]\[\d+\]/, `[steps][${index}]`));
                }
            });
        });
    }

    function updateTestimonialNumbers() {
        document.querySelectorAll('.testimonial-item').forEach((item, index) => {
            item.querySelector('h6').textContent = `Testimonial ${index + 1}`;
            item.setAttribute('data-index', index);
            item.querySelectorAll('input, textarea').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/\[testimonials\]\[\d+\]/, `[testimonials][${index}]`));
                }
            });
        });
    }

    function updateMemberNumbers() {
        document.querySelectorAll('.member-item').forEach((item, index) => {
            item.querySelector('h6').textContent = `Member ${index + 1}`;
            item.setAttribute('data-index', index);
            item.querySelectorAll('input, textarea').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/\[members\]\[\d+\]/, `[members][${index}]`));
                }
            });
        });
    }
});
</script>
@endpush

