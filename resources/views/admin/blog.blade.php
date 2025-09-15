@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0">Manage Blogs</h2>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-success">+ Create Blog</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($Blogss->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Created At</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Blogss as $index => $blog)
                        <tr>
                            <td>{{ $Blogss->firstItem() + $index }}</td>
                            <td>
                                @if($blog->featured_image)
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Thumbnail" class="img-thumbnail" style="width: 80px;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <input type="checkbox"
                                       class="form-check-input toggle-featured"
                                       data-id="{{ $blog->id }}"
                                       {{ $blog->is_featured ? 'checked' : '' }}>
                            </td>
                            <td>
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                {{-- Uncomment below to enable delete --}}
                                {{-- 
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this blog?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form> 
                                --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $Blogss->links() }}
        </div>
    @else
        <p class="text-center">No blogs found.</p>
    @endif
</div>
@endsection

@section('scripts')
<script>
    $(document).on('change', '.toggle-featured', function () {
        const blogId = $(this).data('id');
        const isFeatured = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{ url('/admin/blogs') }}/" + blogId + "/toggle-featured",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                is_featured: isFeatured
            },
            success: function (response) {
                console.log(response.message);
            },
            error: function () {
                alert('Failed to update featured status.');
            }
        });
    });
</script>
@endsection
