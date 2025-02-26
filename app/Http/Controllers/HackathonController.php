<?php

namespace App\Http\Controllers;

use App\Http\Requests\HackathonRequest;
use App\Http\Resources\HackathonResource;
use App\Models\Hackathon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HackathonController extends Controller
{
    // Вывод всех хакатонов
    public function index(): JsonResponse
    {
        return response()->json(HackathonResource::collection(Hackathon::all()));
    }

    // Все хакатоны пользователя
    public function user(Request $request): JsonResponse
    {
        /** @var Hackathon[] $hackathons */
        $hackathons = Hackathon::where('user_id', $request->user()->id)->get();

        return response()->json(HackathonResource::collection($hackathons));
    }

    // Получение хакатона по id
    public function show(Hackathon $hackathon): JsonResponse
    {
        return response()->json(new HackathonResource($hackathon));
    }

    // Создание хакатона
    public function store(HackathonRequest $request): JsonResponse
    {
        /** @var Hackathon $hackathon */
        $hackathon = Hackathon::query()->create([
            'name' => $request->get('name'),
            'registration_date_begin' => $request->get('registration_date_begin'),
            'registration_date_end' => $request->get('registration_date_end'),
            'start_date_begin' => $request->get('start_date_begin'),
            'start_date_end' => $request->get('start_date_end'),
            'max_members_count' => $request->get('max_members_count'),
            'description' => $request->get('description'),
            'task' => $request->get('task'),
            'user_id' => $request->user()->id,
        ]);

        return response()->json(new HackathonResource($hackathon));
    }

    // Обновление хакатона
    public function update(HackathonRequest $request, Hackathon $hackathon): JsonResponse
    {
        if ($hackathon->user_id !== $request->user()->id) {
            return response()->json([], 403);
        }

        $hackathon->update([
            'name' => $request->get('name'),
            'registration_date_begin' => $request->get('registration_date_begin'),
            'registration_date_end' => $request->get('registration_date_end'),
            'start_date_begin' => $request->get('start_date_begin'),
            'start_date_end' => $request->get('start_date_end'),
            'max_members_count' => $request->get('max_members_count'),
            'description' => $request->get('description'),
            'task' => $request->get('task'),
        ]);

        return response()->json(new HackathonResource($hackathon));
    }

    // Удаление хакатона
    public function destroy(Request $request, Hackathon $hackathon): JsonResponse
    {
        if ($hackathon->user_id !== $request->user()->id) {
            return response()->json([], 403);
        }

        $hackathon->delete();

        return response()->json(null, 204);
    }
}
