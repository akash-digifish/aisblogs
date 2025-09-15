<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use Illuminate\Http\Request;
  use App\Mail\PodcastMessageMail;
use Illuminate\Support\Facades\Mail;

class PodcastController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::latest()->paginate(10);
        return response()->json([
            'status' => true,
            'data'   => $podcasts
        ]);
    }



public function store(Request $request)
{
    $validated = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'company' => 'nullable|string|max:255',
        'message'     => 'nullable|string'
    ]);

      $podcast = Podcast::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'company'    => $request->company,
            'msg'         => $request->message,

        ]);
        

   

    // Send podcast notification email
    Mail::to('hello@digifish3.com')->send(new PodcastMessageMail($podcast));

    return response()->json([
        'status'  => true,
        'message' => 'Podcast created successfully!',
        'data'    => $podcast
    ], 201);
}

    public function show(Podcast $podcast)
    {
        return response()->json([
            'status' => true,
            'data'   => $podcast
        ]);
    }

    public function update(Request $request, Podcast $podcast)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'message'     => 'nullable|string'
        ]);



        $podcast->update($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Podcast updated successfully!',
            'data'    => $podcast
        ]);
    }

    public function destroy(Podcast $podcast)
    {
        $podcast->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Podcast deleted successfully!'
        ]);
    }
}
