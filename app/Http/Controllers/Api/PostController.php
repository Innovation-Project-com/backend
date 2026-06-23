<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * GET /api/v1/posts
     * Returns a paginated list of published posts.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Post::published()
            ->with(['category', 'tags'])
            ->latest('published_at');

        // Filter: Category slug
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->query('category'))
                  ->where('is_active', true);
            });
        }

        // Filter: Tag slug
        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->query('tag'));
            });
        }

        // Filter: Search query
        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        // Filter: Featured only
        if ($request->filled('featured')) {
            $featured = filter_var($request->query('featured'), FILTER_VALIDATE_BOOLEAN);
            $query->where('is_featured', $featured);
        }

        // Pagination setup
        $perPage = min((int) $request->query('per_page', 10), 50);
        $posts = $query->paginate($perPage);

        return response()->json([
            'data' => PostResource::collection($posts->items()),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page'    => $posts->lastPage(),
                'per_page'     => $posts->perPage(),
                'total'        => $posts->total(),
            ],
            'message' => 'Success',
        ]);
    }

    /**
     * GET /api/v1/posts/{slug}
     * Returns a single published post with category, tags and related posts.
     */
    public function show(string $slug): JsonResponse
    {
        $post = Post::published()
            ->with(['category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Get 3 related posts from same category, excluding current post
        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        $post->related_posts = $relatedPosts;

        return response()->json([
            'data'    => new PostResource($post),
            'message' => 'Success',
        ]);
    }
}
