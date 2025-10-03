<?php

namespace App\Http\Controllers;

use App\Models\FormLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Store the contact request in the database
            FormLead::create([
                'name' => $request->name,
                'email' => $request->email,
                'company_name' => $request->company,
                'message' => $request->message,
            ]);
            
            // Send email notification
            // Mail::to(config('mail.admin_email'))->send(new ContactFormSubmission($request->all()));

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us. We will get back to you soon!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, something went wrong. Please try again later.'
            ], 500);
        }
    }
} 