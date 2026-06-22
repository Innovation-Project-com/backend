<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Resources\PageResource;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    /**
     * GET /api/v1/pages/{slug}
     * Returns a single published page by slug.
     */
    public function show(string $slug): JsonResponse
    {
        $page = Page::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'data'    => new PageResource($page),
            'message' => 'Success',
        ]);
    }
}
