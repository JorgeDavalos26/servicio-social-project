<?php

namespace App\Helpers;

use App\Models\answer;

class AnswerHelper {

    public static function getAnswers(&$input) {
        // Specific from a solicitude
        $answers = Answer::where("solicitude_id", $input['solicitudeId']);

        // Pagination
        if (isset($input['paginated']) && to_boolean($input['paginated'])) {
            if(!isset($input['perPage'])) $input['perPage'] = 10;
            if(!isset($input['page'])) $input['page'] = 1;
        }
        else {
            $input['page'] = 1;
            $input['perPage'] = 100000;
        }

        // OrderBy
        if (isset($input['orderBy'])) {
            $answers = $answers->orderBy('id', to_boolean($input['orderBy'])?'asc':'desc');
        }
        else {
            $answers = $answers->orderBy('id', 'asc');
        }

        // Obtain result
        $answers = $answers->paginate($input['perPage']);

        return $answers;
    }

    public static function createAnswer($input) {
        return Answer::create([
            'question_id' => $input['questionId'],
            'solicitude_id' => $input['solicitudeId'],
            'value' => $input['value'],
        ]);
    }

    public static function updateAnswer($answer, $input) {
        if (isset($input['questionId'])) {
            $answer->question_id = $input['questionId'];
        }
        if (isset($input['solicitudeId'])) {
            $answer->solicitude_id = $input['solicitudeId'];
        }
        if (isset($input['value'])) {
            $answer->value = $input['value'];
        }
        $answer->save();
        return $answer;
    }

}