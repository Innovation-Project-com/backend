<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PageView;
use App\Models\Solution;
use App\Models\Post;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PageViewController extends Controller
{
    /**
     * POST /api/v1/track
     * Records a page view.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page_url'   => ['required', 'string', 'max:2000'],
            'page_type'  => ['required', 'string', 'max:100'],
            'session_id' => ['required', 'string', 'max:255'],
            'slug'       => ['nullable', 'string', 'max:255'],
            'referer'    => ['nullable', 'string', 'max:2000'],
        ]);

        // Resolve polymorphic referrable model if slug is provided
        $referrable = null;
        if (!empty($validated['slug'])) {
            $slug = $validated['slug'];
            $type = $validated['page_type'];

            if ($type === 'solution') {
                $referrable = Solution::where('slug', $slug)->first();
            } elseif ($type === 'post') {
                $referrable = Post::where('slug', $slug)->first();
            } elseif ($type === 'page') {
                $referrable = Page::where('slug', $slug)->first();
            }
        }

        // Create page view record
        $pageView = new PageView();
        $pageView->page_url = $validated['page_url'];
        $pageView->page_type = $validated['page_type'];
        $pageView->session_id = $validated['session_id'];
        $pageView->visitor_ip = hash('sha256', $request->ip());
        $pageView->user_agent = $request->userAgent();
        $pageView->referer = $validated['referer'] ?? $request->header('referer');

        if ($referrable) {
            $pageView->referrable()->associate($referrable);
        }

        $pageView->save();

        return response()->json([
            'message' => 'Page view tracked successfully.',
        ], 201);
    }
}
