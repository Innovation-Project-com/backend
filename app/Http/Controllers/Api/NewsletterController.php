<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NewsletterController extends Controller
{
    /**
     * POST /api/v1/newsletter/subscribe
     * Subscribes a user to the newsletter.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ], [
            'email.required' => 'Please enter a valid email address.',
            'email.email'    => 'Please enter a valid email address.',
        ]);

        $subscriber = NewsletterSubscriber::where('email', $validated['email'])->first();

        if ($subscriber) {
            if ($subscriber->is_active) {
                return response()->json([
                    'message' => 'You are already subscribed to our newsletter.',
                ], 200);
            }

            // Reactivate subscriber
            $subscriber->update([
                'is_active' => true,
                'subscribed_at' => now(),
            ]);

            return response()->json([
                'message' => 'Thank you for re-subscribing to our newsletter!',
            ], 200);
        }

        NewsletterSubscriber::create([
            'email'         => $validated['email'],
            'subscribed_at' => now(),
            'is_active'     => true,
        ]);

        return response()->json([
            'message' => 'Thank you for subscribing to our newsletter!',
        ], 201);
    }
}
