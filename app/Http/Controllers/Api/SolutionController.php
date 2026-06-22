<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use App\Http\Resources\SolutionResource;
use Illuminate\Http\JsonResponse;

class SolutionController extends Controller
{
    /**
     * GET /api/v1/solutions
     * Returns all published solutions.
     */
    public function index(): JsonResponse
    {
        $solutions = Solution::published()
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'short_description', 'og_image']);

        return response()->json([
            'data'    => SolutionResource::collection($solutions),
            'message' => 'Success',
        ]);
    }

    /**
     * GET /api/v1/solutions/{slug}
     * Returns a single published solution by slug.
     */
    public function show(string $slug): JsonResponse
    {
        $solution = Solution::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'data'    => new SolutionResource($solution),
            'message' => 'Success',
        ]);
    }
}
