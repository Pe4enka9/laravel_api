<?php

namespace App\Http\Resources;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Answer
 */
class AnswerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'text' => $this->text,
        ];
    }
}
