<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Http\Resources\SiteSettingResource;
use Illuminate\Http\JsonResponse;

class SiteSettingController extends Controller
{
    /**
     * GET /api/v1/site-settings
     * Returns the global site settings.
     */
    public function index(): JsonResponse
    {
        $settings = SiteSetting::getSetting();

        if (! $settings) {
            return response()->json([
                'data'    => null,
                'message' => 'Site settings not configured.',
            ]);
        }

        return response()->json([
            'data'    => new SiteSettingResource($settings),
            'message' => 'Success',
        ]);
    }
}
