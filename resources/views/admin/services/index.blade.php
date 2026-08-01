@extends('layouts.app')

@section('content')
    @section('title', 'Manage Services')

    <div class="card ag-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">All Services</h5>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-plus me-1"></i> Add New
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($service->image)
                                        <img src="{{ asset($service->image) }}" class="rounded me-2 shadow-sm" style="width: 32px; height: 32px; object-fit: cover;">
                                    @endif
                                    <span>{{ $service->name }}</span>
                                </div>
                            </td>
                            <td>{{ $service->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-icon text-primary"><i class="mdi mdi-pencil-outline"></i></a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-icon text-danger"><i class="mdi mdi-delete-outline"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $services->links() }}
            </div>
        </div>
    </div>
@endsection
