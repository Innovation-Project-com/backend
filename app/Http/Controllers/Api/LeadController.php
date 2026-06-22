<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use App\Services\LeadService;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    public function __construct(private readonly LeadService $leadService) {}

    /**
     * POST /api/v1/leads
     * Stores a contact form submission.
     */
    public function store(StoreLeadRequest $request): JsonResponse
    {
        $lead = $this->leadService->createLead($request->validated());

        return response()->json([
            'data'    => ['id' => $lead->id],
            'message' => 'Your consultation request has been sent. Our team will review your message and contact you soon.',
        ], 201);
    }
}
