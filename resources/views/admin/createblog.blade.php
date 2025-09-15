@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Create New Blog</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>There were some errors:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- <div class="mb-3">
            <label>Blog Name</label>
            <input type="text" name="blog_name" class="form-control" value="{{ old('blog_name') }}" required>
        </div> -->

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <!-- <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
        </div> -->

        <div class="mb-3">
            <label>Description</label>
            <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
        </div>

        <div class="mb-3">
            <label>Create Date</label>
            <input type="date" name="create_date" class="form-control" value="{{ old('create_date') }}" required>
        </div>

      <div class="mb-3">
            <label>Publish Date</label>
            <input type="text" name="published_at" class="form-control" value="{{ old('published_at') }}">
        </div>


        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>

          {{-- ✅ Thumbnail Upload --}}
            <div class="mb-3">
                <label>Thumbnail Image</label>
                <input type="file" name="thumbnail" class="form-control" id="thumbnail" accept="image/*">
                <img id="thumbnail_preview" src="#" alt="Thumbnail Preview" style="max-height: 200px; display: none;" class="mt-2" />
            </div>

        <div class="mb-3">
            <label>Featured Image</label>
            <input type="file" name="featured_image" class="form-control" id="featured_image" accept="image/*">
            <img id="preview" src="#" alt="Featured Preview" style="max-height: 200px; display: none;" class="mt-2" />
        </div>

      

        <div class="mb-3">
            <label>Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
        </div>

        <div class="mb-3">
            <label>Meta Keywords</label>
            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}">
        </div>

        <div class="mb-3">
            <label>Meta Description</label>
            <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description') }}">
        </div>

        <div class="mb-3">
            <label>Is Featured?</label>
            <select name="is_featured" class="form-control">
                <option value="0" {{ old('is_featured') == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tags (comma separated)</label>
            <input type="text" name="tags[]" class="form-control" value="{{ old('tags.0') }}">
        </div>

        <div class="mb-3">
            <label>View Count</label>
            <input type="number" name="view_count" class="form-control" value="{{ old('view_count') }}">
        </div>

        <div class="mb-3">
            <label>Read Time (minutes)</label>
            <input type="number" name="read_time" class="form-control" value="{{ old('read_time') }}">
        </div>

        <div class="mb-3">
            <label>Language</label>
            <input type="text" name="language" class="form-control" value="{{ old('language') }}">
        </div>

        <div class="mb-3">
            <label>Visibility</label>
            <select name="visibility" class="form-control" required>
                <option value="public" {{ old('visibility') === 'public' ? 'selected' : '' }}>Public</option>
                <option value="private" {{ old('visibility') === 'private' ? 'selected' : '' }}>Private</option>
                <option value="unlisted" {{ old('visibility') === 'unlisted' ? 'selected' : '' }}>Unlisted</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Blog</button>
    </form>
</div>

{{-- ✅ Load CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

{{-- ✅ Image Previews --}}
<script>
    // Featured Image Preview
    document.getElementById("featured_image").addEventListener("change", function(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const img = document.getElementById("preview");
            img.src = reader.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    // Thumbnail Preview
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

{{-- ✅ CKEditor Init --}}
<script>
    let ckEditorInstance;

    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            ckEditorInstance = editor;
        })
        .catch(error => {
            console.error('CKEditor init error:', error);
        });

    document.querySelector('form').addEventListener('submit', function (e) {
        if (ckEditorInstance) {
            const data = ckEditorInstance.getData().trim();
            document.querySelector('#description').value = data;

            if (!data) {
                e.preventDefault();
                alert("Description is required.");
                return false;
            }
        }
    });
</script>
@endsection
