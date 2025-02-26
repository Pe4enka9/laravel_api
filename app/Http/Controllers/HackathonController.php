<?php

namespace App\Http\Controllers;

use App\Http\Requests\HackathonRequest;
use App\Http\Resources\HackathonResource;
use App\Models\Hackathon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HackathonController extends Controller
{
    /**
     * Вывод всех хакатонов
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(HackathonResource::collection(Hackathon::all()));
    }

    /**
     * Все хакатоны пользователя
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function user(Request $request): JsonResponse
    {
        /** @var Hackathon[] $hackathons */
        $hackathons = Hackathon::where('user_id', $request->user()->id)->get();

        return response()->json(HackathonResource::collection($hackathons));
    }

    /**
     * Получение хакатона по id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        /** @var Hackathon $hackathon */
        $hackathon = Hackathon::find($id);

        return response()->json(new HackathonResource($hackathon));
    }

    /**
     * Создание хакатона
     *
     * @param HackathonRequest $request
     * @return JsonResponse
     */
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

    /**
     * Обновление хакатона
     *
     * @param HackathonRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(HackathonRequest $request, int $id): JsonResponse
    {
        /** @var Hackathon $hackathon */
        $hackathon = Hackathon::find($id);

        if (!$hackathon) {
            return response()->json([], 404);
        }

        if ($hackathon->user_id === $request->user()->id) {
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

        return response()->json([], 403);
    }
}
