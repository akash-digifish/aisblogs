@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Blog</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Errors:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
<!-- 
        <div class="mb-3">
            <label>Title</label>   
            <input type="text" name="blog_name" value="{{ old('blog_name', $blog->blog_name) }}" class="form-control">
        </div> -->

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $blog->title) }}" class="form-control" required>
        </div>

        <!-- <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $blog->subtitle) }}" class="form-control">
        </div> -->

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" rows="5" class="form-control" required>{{ old('description', $blog->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" value="{{ old('author', $blog->author) }}" class="form-control" required>
        </div>

      <div class="mb-3">
            <label>Create Date</label>
            <input type="date" name="create_date" value="{{ old('create_date', optional($blog->create_date)->format('Y-m-d')) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Published At</label>
            <input type="text" name="published_at" value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}" class="form-control">
        </div>

        <!-- <div class="mb-3">
            <label>Publish Date</label>
            <input type="text" name="published_at" class="form-control" value="{{ old('published_at') }}">
        </div> -->


        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                @foreach(['draft', 'published', 'archived'] as $status)
                    <option value="{{ $status }}" {{ old('status', $blog->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

      

        {{-- Thumbnail Image --}}
        <div class="mb-3">
            <label>Thumbnail Image</label>
            <input type="file" name="thumbnail" class="form-control" id="thumbnail" accept="image/*">
            @if ($blog->thumbnail)
                <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="Thumbnail" id="thumbnail_preview" class="img-fluid mt-2" style="max-height: 200px;">
            @else
                <img id="thumbnail_preview" class="img-fluid mt-2" style="max-height: 200px; display:none;">
            @endif
        </div>

          {{-- Featured Image --}}
        <div class="mb-3">
            <label>Featured Image</label>
            <input type="file" name="featured_image" class="form-control" id="featured_image" accept="image/*">
            @if ($blog->featured_image)
                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Featured Image" id="featured_preview" class="img-fluid mt-2" style="max-height: 200px;">
            @else
                <img id="featured_preview" class="img-fluid mt-2" style="max-height: 200px; display:none;">
            @endif
        </div>

        <div class="mb-3">
            <label>Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Meta Description</label>
            <textarea name="meta_description" class="form-control">{{ old('meta_description', $blog->meta_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Meta Keywords</label>
            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $blog->meta_keywords) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Is Featured?</label>
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>
        </div>

        <div class="mb-3">
            <label>Read Time (in minutes)</label>
            <input type="number" name="read_time" value="{{ old('read_time', $blog->read_time) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Visibility</label>
            <select name="visibility" class="form-control" required>
                @foreach(['public', 'private', 'unlisted'] as $visibility)
                    <option value="{{ $visibility }}" {{ old('visibility', $blog->visibility) == $visibility ? 'selected' : '' }}>{{ ucfirst($visibility) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tags (comma separated)</label>
            <input type="text" name="tags[]" value="{{ implode(',', json_decode($blog->tags ?? '[]')) }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Blog</button>
    </form>
</div>

{{-- JS Preview --}}
<script>
    document.getElementById("featured_image").addEventListener("change", function(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const img = document.getElementById("featured_preview");
            img.src = reader.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    document.getElementById("thumbnail").addEventListener("change", function(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const img = document.getElementById("thumbnail_preview");
            img.src = reader.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection
