<?php

namespace App\Http\Resources;

use App\Models\Command;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Command
 */
class CommandResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'owner' => [
                'id' => $this->owner_id,
                'first_name' => $this->owner->first_name,
                'last_name' => $this->owner->last_name,
                'birth_date' => $this->owner->birth_date,
                'email' => $this->owner->email,
            ],
            'teammates' => UserResource::collection($this->teammates),
        ];
    }
}
