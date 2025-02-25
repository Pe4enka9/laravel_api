<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HackathonResource extends JsonResource
{
    /**
     * Преобразование Hackathon
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'registration_date_begin' => $this->registration_date_begin,
            'registration_date_end' => $this->registration_date_end,
            'start_date_begin' => $this->start_date_begin,
            'start_date_end' => $this->start_date_end,
            'max_members_count' => $this->max_members_count,
            'description' => $this->description,
            'task' => $this->task,
        ];
    }
}
