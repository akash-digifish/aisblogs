<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Podcast;

class BlogsController extends Controller
{
    // Show all Blogs
    public function index()
    {
        $Blogss = Blogs::latest()->paginate(500);
        return view('admin.blog', compact('Blogss'));
    }

    public function toggleFeatured(Request $request, $id)
{
    $blog = Blogs::findOrFail($id);
    $blog->is_featured = $request->is_featured;
    $blog->save();

    return response()->json(['message' => 'Featured status updated']);
}


    // Show a single blog for users
    public function showdata($id)
    {
        $blog = Blogs::findOrFail($id);
        return view('user.blog', compact('blog'));
    }

    // Show create form
    public function create()
    {
        return view('admin.createblog');
    }

    // Store new Blog
    public function store(Request $request)
    {
        $validated = $this->validateBlogs($request);

          $validated['blog_name'] =$request->title;

        // Auto-generate slug from title or blog_name
        $validated['slug'] = Str::slug($validated['title'] ?? $validated['blog_name']);
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Blogs::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter++;
        }

        $validated['view_count'] = 1;
        $validated['language'] = 'en';

        // Handle image uploads
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->uploadImage($request->file('featured_image'));
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->uploadImage($request->file('thumbnail'));
        }

        $validated['tags'] = $request->has('tags') ? json_encode($request->tags) : null;

        Blogs::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    // Show single Blog (for admin)
    public function show(Blogs $Blogs)
    {
        return view('Blogss.show', compact('Blogs'));
    }

    // Show edit form
    public function edit(Blogs $blog)
    {
        return view('admin.editblog', compact('blog'));
    }

 
public function update(Request $request, Blogs $blog)
{
    $validated = $this->validateBlogs($request, $blog->id);

    // Handle featured image upload
     $validated['blog_name'] =$request->title;
    if ($request->hasFile('featured_image')) {
        $validated['featured_image'] = $this->uploadImage($request->file('featured_image'));
    }

    // Handle thumbnail image upload
    if ($request->hasFile('thumbnail')) {
        $validated['thumbnail'] = $this->uploadImage($request->file('thumbnail'));
    }

    // Handle tags (comma-separated input to JSON array)
    if ($request->has('tags')) {
        $tagsInput = $request->input('tags'); // will be comma separated string
        $validated['tags'] = json_encode(explode(',', $tagsInput[0]));
    } else {
        $validated['tags'] = null;
    }

    // Handle checkbox value for is_featured
    $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

    $blog->update($validated);

    return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
}




    // Delete blog
    public function destroy(Blogs $Blogs)
    {
        // dd($Blogs->id);
        $Blogs->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }

    // Common validation method
    private function validateBlogs(Request $request, $BlogsId = null)
    {
        return $request->validate([
            'blog_name'        => 'nullable|string|max:255',
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string|max:255',
            'description'      => 'required|string',
            'author'           => 'required|string|max:100',
            'create_date'      => 'required|date',
            'published_at'     => 'nullable|date',
            'status'           => 'required|in:draft,published,archived',
            'featured_image'   => 'nullable|image|max:2048',
            'thumbnail'        => 'sometimes|image|max:2048', // ✅ thumbnail validation
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords'    => 'nullable|string|max:255',
            'is_featured'      => 'nullable|boolean',
            'tags'             => 'nullable|array',
            'tags.*'           => 'string',
            'view_count'       => 'nullable|integer',
            'read_time'        => 'nullable|integer',
            'language'         => 'nullable|string|max:10',
            'visibility'       => 'required|in:public,private,unlisted',
        ]);
    }

    // Upload and store images
    private function uploadImage($file, $folder = 'Blogs_images')
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($folder, $filename, 'public');
        return $folder . '/' . $filename;
    }

     public function contacts()
    {
      $contacts = ContactMessage::latest()->paginate(1000);
    return view('admin.contacts.index', compact('contacts'));
    }

    
    public function podcasts()
    {
        $podcasts = Podcast::latest()->paginate(100);
         return view('admin.podcasts.index', compact('podcasts'));
      
    }
}
