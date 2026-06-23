<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Http\Resources\PartnerResource;
use Illuminate\Http\JsonResponse;

class PartnerController extends Controller
{
    /**
     * GET /api/v1/partners
     * Returns all active partners.
     */
    public function index(): JsonResponse
    {
        $partners = Partner::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'data'    => PartnerResource::collection($partners),
            'message' => 'Success',
        ]);
    }
}
