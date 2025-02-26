<?php

namespace App\Http\Requests;

class HackathonRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'registration_date_begin' => ['required', 'date:Y-m-d'],
            'registration_date_end' => ['required', 'date:Y-m-d'],
            'start_date_begin' => ['required', 'date:Y-m-d'],
            'start_date_end' => ['required', 'date:Y-m-d'],
            'max_members_count' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'task' => ['required', 'string'],
        ];
    }
}
