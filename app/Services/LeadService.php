<?php

namespace App\Services;

use App\Models\Lead;

/**
 * LeadService handles business logic for contact form submissions.
 */
class LeadService
{
    /**
     * Create a new lead from a validated form submission.
     */
    public function createLead(array $data): Lead
    {
        $lead = Lead::create([
            'name'                => $data['name'],
            'company'             => $data['company'] ?? null,
            'email'               => $data['email'],
            'phone'               => $data['phone'] ?? null,
            'interested_solution' => $data['interested_solution'] ?? null,
            'message'             => $data['message'],
            'source_page'         => $data['source_page'] ?? null,
            'status'              => 'new',
        ]);

        // TODO: Send email notification to admin
        // $this->notificationService->notifyNewLead($lead);

        return $lead;
    }
}
