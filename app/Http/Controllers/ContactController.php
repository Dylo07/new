<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = [
            'address' => '123 Hotel Street, City, Country',
            'phone' => '+1 234 567 890',
            'email' => 'info@yourhotel.com',
            'social' => [
                'facebook' => 'https://facebook.com/yourhotel',
                'instagram' => 'https://instagram.com/yourhotel',
                'twitter' => 'https://twitter.com/yourhotel'
            ]
        ];

        return view('contact.index', compact('contactInfo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Here you can add your email sending logic
        // For example:
        // Mail::to('your@email.com')->send(new ContactFormMail($validated));

        return redirect()->route('contact')
            ->with('success', 'Thank you for your message. We will contact you soon!');
    }
}
