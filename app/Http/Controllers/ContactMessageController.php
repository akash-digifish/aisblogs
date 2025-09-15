<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Log;


class ContactMessageController extends Controller
{
    
   


public function store(Request $request)
{
    // Validate input
    $request->validate([
        'name'         => 'required|string|max:255',
        'email'        => 'required|email',
        'country_code' => 'nullable|string|max:10',
        'phone'       => 'nullable|string|max:16',
        'company'      => 'nullable|string|max:255',
        'message'      => 'nullable|string',
         'country_name'   => 'nullable|string|max:100',
    ]);

    try {
        // Save contact message
        $contact = ContactMessage::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'country_code'    => $request->country_code,
            'mobile'          => $request->phone,
            'company'         => $request->company,
            'message'         => $request->message,
             'country_name'     => $request->country_name,
            'accepted_policy' => true,
        ]);
        

        Mail::to('hello@arshiyainfosolutions.com')->send(new ContactMessageMail($contact));

        return response()->json([
            'success' => true,
            'message' => 'Your message has been submitted successfully!',
            'data'    => $contact,
        ]);

    } catch (\Exception $e) {
        Log::error('Contact form submission error: '.$e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'There was an error submitting your message. Please try again later.',
            'error'   => $e->getMessage(),
        ], 500);
    }
}
public function connectemailstore(Request $request)
{
    // Validate input
    $request->validate([
        'email'        => 'required|email',
    ]);

    try {
        // Save contact message
        $contact = ContactMessage::create([
            'name'            => $request->email,
            'email'           => $request->email,
            'accepted_policy' => true,
        ]);

        // Send email
        Mail::to('hello@arshiyainfosolutions.com')->send(new ContactMessageMail($contact));

        return response()->json([
            'success' => true,
            'message' => 'Your message has been submitted successfully!',
            'data'    => $contact,
        ]);

    } catch (\Exception $e) {
        Log::error('Contact form submission error: '.$e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'There was an error submitting your message. Please try again later.',
            'error'   => $e->getMessage(),
        ], 500);
    }
}





    
    public function index()
    {
        $messages = ContactMessage::latest()->get();

        return response()->json([
            'success' => true,
            'count'   => $messages->count(),
            'data'    => $messages
        ]);
    }

   
    public function show($id)
    {
        $message = ContactMessage::find($id);

        if (!$message) {
            return response()->json([
                'success' => false,
                'message' => 'Message not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $message
        ]);
    }
}
