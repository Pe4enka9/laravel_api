<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandRequest;
use App\Http\Resources\CommandResource;
use App\Models\Command;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CommandController extends Controller
{
    // Создание команды
    public function store(CommandRequest $commandRequest): JsonResponse
    {
        $command = Command::query()->create([
            'name' => $commandRequest->name,
            'code' => Str::random(6),
            'hackathon_id' => $commandRequest->hackathon_id,
            'owner_id' => $commandRequest->user()->id,
            'teammates' => [],
        ]);

        return response()->json(new CommandResource($command));
    }
}
