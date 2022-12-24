<?php

namespace App\Http\Controllers;

use App\Helpers\QuestionHelper;
use App\Http\Requests\QuestionGetRequest;
use App\Http\Requests\QuestionPostRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index(QuestionGetRequest $request)
    {
        $input = $request->validated();
        $questions = QuestionHelper::getQuestions($input);
        $additionalData = [
            "paginationTotalItems" => $questions->total(),
            "paginationPerPage" => (int)$input['perPage'],
            "paginationPage" => (int)$input['page']
        ];
        return response()->success(new QuestionCollection($questions), $additionalData);
    }

    public function store(QuestionPostRequest $request)
    {
        $input = $request->validated();
        $question = QuestionHelper::createQuestion($input);
        return response()->success(new QuestionResource($question));
    }

    public function show(Question $question)
    {
        return response()->success(new QuestionResource($question));
    }

    public function update(QuestionUpdateRequest $request, Question $question)
    {
        $input = $request->validated();
        $question = QuestionHelper::updateQuestion($question, $input);
        return response()->success(new QuestionResource($question));
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response()->success(new QuestionResource($question));
    }
}
