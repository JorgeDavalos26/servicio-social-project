<?php

namespace App\Http\Resources;

use App\Models\Answer;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SolicitudeCompleteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $questions = $this->form->questions; // get questions of the solicitude's form
        $answers = $this->answers; // get solicitude's answers

        foreach ($questions as &$question) { // check if each question has an answer already
            $answer = $answers->where('question_id', '=', $question->id)->first(); // get the answer of given question
            if ($answer != null) $question['answer'] = new AnswerResource($answer); // insert the formatted answer into question
        }

        $formattedQuestions = new QuestionCollection($questions); // format each of the questions

        return [
                "id" => $this->id,
                "status" => $this->status,
                "period" => new PeriodResource($this->period),
                "form" => new FormResource($this->form),
                "questions" => $formattedQuestions,
                "createdAt" => $this->created_at,
                "updatedAt" => $this->updated_at
            ] + (Auth::check() && Auth::user()->is_admin ? array("user" => $this->user) : []);
    }
}
