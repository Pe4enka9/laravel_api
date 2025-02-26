<?php

namespace App\Http\Requests;

class AnswerRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'text' => ['required', 'string'],
        ];
    }
}
