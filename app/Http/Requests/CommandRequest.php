<?php

namespace App\Http\Requests;

use App\Models\Command;
use App\Models\Hackathon;
use App\Models\User;
use Illuminate\Validation\Rule;

class CommandRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'code' => ['string', Rule::unique(Command::class, 'code')],
            'hackathon_id' => ['integer', Rule::exists(Hackathon::class, 'id')],
            'owner_id' => ['integer', Rule::exists(User::class, 'id')],
            'teammates' => ['nullable', 'array'],
        ];
    }
}
