<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'calendar_id' => 'required|exists:calendars,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'color' => 'nullable|string|max:20',
            'start_time' => 'nullable|date_format:H:i:s',
            'end_time' => 'nullable|date_format:H:i:s|after_or_equal:start_time',
            'recurrence_type' => 'nullable|in:daily,weekly,monthly,yearly,special',
            'recurrence_interval' => 'nullable|integer|min:1',
            'recurrence_repeats' => 'nullable|integer|min:1',
            'recurrence_days' => 'nullable|array',
            'recurrence_days.*' => 'string',
            'parent_event_id' => 'nullable|exists:events,id',
        ];
    }
}
