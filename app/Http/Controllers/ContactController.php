<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Handle contact form submission
     */
    public function submit(Request $request)
    {
        // Validate form input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ]);

        // Save to database
        ContactSubmission::create($validated);

        // You can send email notification here:
        // Mail::send(new ContactFormNotification($validated));

        // Return JSON for AJAX requests
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cảm ơn bạn! Chúng tôi sẽ liên hệ với bạn sớm.',
            ]);
        }

        // Redirect with success message for regular form submissions
        return back()->with('success', 'Cảm ơn bạn! Chúng tôi sẽ liên hệ với bạn sớm.');
    }
}
