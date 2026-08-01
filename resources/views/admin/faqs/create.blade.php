@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card ag-card">
                <div class="card-header">
                    <h5 class="mb-0">Create New FAQ</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.faqs.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold">Question <span class="text-danger">*</span></label>
                            <input type="text" name="question" value="{{ old('question') }}"
                                class="form-control form-control-lg" placeholder="Enter FAQ question..." required maxlength="500">
                            <small class="text-muted">Maximum 500 characters</small>
                            @error('question')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Answer <span class="text-danger">*</span></label>
                            <textarea name="answer" class="form-control" rows="5" placeholder="Enter FAQ answer..." required>{{ old('answer') }}</textarea>
                            @error('answer')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Service (Optional)</label>
                                <select name="service_id" class="form-select">
                                    <option value="">General FAQ (All Services)</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id', request('service_id')) == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Select a service to make this FAQ specific to that service, or leave blank for general FAQ</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Order</label>
                                <input type="number" name="order" value="{{ old('order', 0) }}"
                                    class="form-control" placeholder="0" min="0">
                                <small class="text-muted">Lower numbers appear first</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <strong>Active</strong>
                                </label>
                            </div>
                            <small class="text-muted">Only active FAQs will be displayed on the website</small>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="mdi mdi-check me-1"></i>
                                Create FAQ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

