@extends('layouts.app')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    @section('title', 'Manage FAQs')

    <div class="card ag-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">All FAQs</h5>
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-plus me-1"></i> Add New FAQ
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Service</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $faq)
                        <tr>
                            <td>
                                <strong>{{ Str::limit($faq->question, 60) }}</strong>
                            </td>
                            <td>
                                @if($faq->service)
                                    <span class="badge bg-info">{{ $faq->service->name }}</span>
                                @else
                                    <span class="badge bg-secondary">General</span>
                                @endif
                            </td>
                            <td>{{ $faq->order }}</td>
                            <td>
                                @if($faq->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-icon text-primary"><i class="mdi mdi-pencil-outline"></i></a>
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-icon text-danger"><i class="mdi mdi-delete-outline"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No FAQs found. <a href="{{ route('admin.faqs.create') }}">Create one</a></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $faqs->links() }}
            </div>
        </div>
    </div>
@endsection

