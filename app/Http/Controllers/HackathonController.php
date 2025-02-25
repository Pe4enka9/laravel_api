<?php

namespace App\Http\Controllers;

use App\Http\Resources\HackathonResource;
use App\Models\Hackathon;
use Illuminate\Http\JsonResponse;

class HackathonController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(HackathonResource::collection(Hackathon::all()));
    }
}
