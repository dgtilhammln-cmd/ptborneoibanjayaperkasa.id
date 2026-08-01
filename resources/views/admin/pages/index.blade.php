@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Pages</h1>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus"></i> Add New Page
            </a>
        </div>

        <div class="ag-card">
            <div class="card-body p-0">
                <table class="table ag-table mb-0">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>SEO</th>
                            <th>Status</th>
                            <th>Menu</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pages as $page)
                            <tr>
                                <td>{{ $page->order }}</td>
                                <td>
                                    <strong>{{ $page->title }}</strong>
                                    @if($page->meta_title)
                                        <br><small class="text-muted">SEO: {{ Str::limit($page->meta_title, 40) }}</small>
                                    @endif
                                </td>
                                <td><code>/page/{{ $page->slug }}</code></td>
                                <td>
                                    @if($page->meta_title && $page->meta_description)
                                        <span class="badge bg-success" title="SEO Complete">
                                            <i class="mdi mdi-check-circle"></i> Complete
                                        </span>
                                    @elseif($page->meta_title || $page->meta_description)
                                        <span class="badge bg-warning" title="SEO Partial">
                                            <i class="mdi mdi-alert-circle"></i> Partial
                                        </span>
                                    @else
                                        <span class="badge bg-secondary" title="No SEO">
                                            <i class="mdi mdi-close-circle"></i> None
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($page->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    @if($page->show_in_menu)
                                        <i class="mdi mdi-check-circle text-success"></i>
                                    @else
                                        <i class="mdi mdi-close-circle text-muted"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="/page/{{ $page->slug }}" target="_blank" class="btn btn-sm btn-outline-info"
                                        title="View">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-outline-warning"
                                        title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete this page?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No pages found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($pages->hasPages())
                <div class="card-footer">
                    {{ $pages->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection