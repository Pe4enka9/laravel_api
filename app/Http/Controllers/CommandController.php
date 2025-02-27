<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandRequest;
use App\Http\Resources\CommandResource;
use App\Models\Command;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        ]);

        return response()->json(new CommandResource($command));
    }

    // Команды пользователя
    public function getUserCommands(Request $request): JsonResponse
    {
        $commands = Command::query()->where('owner_id', $request->user()->id)->get();

        return response()->json(CommandResource::collection($commands));
    }

    // Просмотр команды по коду
    public function getCommand(Command $command): JsonResponse
    {
        return response()->json(new CommandResource($command));
    }

    // Присоединение к команде по коду
    public function storeTeammate(Request $request, Command $command): JsonResponse
    {
        $command->teammates()->attach($request->user()->id);

        return response()->json(new CommandResource($command));
    }

    // Удаление члена команды
    public function destroyTeammate(Command $command, User $user): JsonResponse
    {
        $command->teammates()->detach($user->id);

        return response()->json(new CommandResource($command));
    }
}
