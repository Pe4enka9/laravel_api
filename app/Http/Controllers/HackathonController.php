<?php

namespace App\Http\Controllers;

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
}
