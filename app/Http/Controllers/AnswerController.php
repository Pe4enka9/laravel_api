<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Hackathon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Получение ответа на хакатон
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function answer(Request $request, int $id): JsonResponse
    {
        $answer = Answer::where('hackathon_id', $id)->first();

        if (!$answer) {
            return response()->json([], 404);
        }

        if (Hackathon::find($answer->hackathon_id)->user_id !== $request->user()->id) {
            return response()->json([], 403);
        }

        return response()->json(['text' => $answer->text]);
    }
}
