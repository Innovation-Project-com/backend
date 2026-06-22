<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates lead/contact form submissions.
 * Rules from docs/AGENTS.md §18 Lead Form Rules
 */
class StoreLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Public endpoint — no auth required
    }

    public function rules(): array
    {
        return [
            'name'                => ['required', 'string', 'max:120'],
            'company'             => ['nullable', 'string', 'max:160'],
            'email'               => ['required', 'email', 'max:160'],
            'phone'               => ['nullable', 'string', 'max:40'],
            'interested_solution' => ['nullable', 'string', 'max:120'],
            'message'             => ['required', 'string', 'max:2000'],
            'source_page'         => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Please enter your name.',
            'email.required'   => 'Please enter a valid email address.',
            'email.email'      => 'Please enter a valid email address.',
            'message.required' => 'Please enter your message.',
            'message.max'      => 'Your message must be less than 2000 characters.',
        ];
    }
}
