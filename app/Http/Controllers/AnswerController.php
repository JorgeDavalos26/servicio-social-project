<?php

namespace App\Http\Controllers;

use App\Helpers\AnswerHelper;
use App\Http\Requests\AnswerGetRequest;
use App\Http\Requests\AnswerMediasPostRequest;
use App\Http\Requests\AnswerPostRequest;
use App\Http\Requests\AnswersPostRequest;
use App\Http\Requests\AnswerUpdateRequest;
use App\Http\Resources\AnswerCollection;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Solicitude;

class AnswerController extends Controller
{
    public function index(AnswerGetRequest $request)
    {
        $input = $request->validated();
        $answers = AnswerHelper::getAnswers($input);
        $additionalData = [
            "paginationTotalItems" => $answers->total(),
            "paginationPerPage" => (int)$input['perPage'],
            "paginationPage" => (int)$input['page']
        ];
        return response()->success(new AnswerCollection($answers), $additionalData);
    }

    public function store(AnswerPostRequest $request)
    {
        $input = $request->validated();
        $answer = AnswerHelper::createAnswer($input);
        return response()->success(new AnswerResource($answer));
    }

    public function show(Answer $answer)
    {
        return response()->success(new AnswerResource($answer));
    }

    public function update(AnswerUpdateRequest $request, Answer $answer)
    {
        $input = $request->validated();
        $answer = AnswerHelper::updateAnswer($answer, $input);
        return response()->success(new AnswerResource($answer));
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();
        return response()->success(new AnswerResource($answer));
    }

    public function storeBulk(AnswersPostRequest $request)
    {
        $input = $request->validated();
        $answers = AnswerHelper::createBulkAnswers($input);
        return response()->success(new AnswerCollection($answers));
    }

    public function updateMediaAnswer(Solicitude $solicitude, Question $question, AnswerMediasPostRequest $request)
    {
        $input = $request->validated();
        $answer = AnswerHelper::updateMediaAnswer($solicitude, $question, $input);
        if ($answer == null) return response()->error(__("Field type not matched"), 401);
        return response()->success(new AnswerResource($answer));
    }

}
