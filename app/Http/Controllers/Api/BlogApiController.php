<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogApiController extends Controller
{

public function index(Request $request)
{
    $now = Carbon::now('Asia/Kolkata')->toDateTimeString();

    $query = Blogs::where('is_featured', 1)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', $now)
        ->where('visibility', 'public');

    if ($request->filled('author')) {
        $query->where('author', 'like', '%' . $request->author . '%');
    }

    if ($request->filled('tag')) {
        $query->whereJsonContains('tags', $request->tag);
    }

    if ($request->filled('from')) {
        $query->whereDate('create_date', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('create_date', '<=', $request->to);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    return response()->json([
        'data' => $query->latest()->paginate(200)
    ]);
}



    // GET /api/blogs/{slug}
    public function show($slug)
    {
        $blog = Blogs::where('slug', $slug)->firstOrFail();

        return response()->json([
            'data' => $blog
        ]);
    }
    
}
