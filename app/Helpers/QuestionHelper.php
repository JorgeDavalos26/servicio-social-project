<?php

namespace App\Helpers;

use App\Models\Question;

class QuestionHelper {

    public static function getQuestions(&$input) {
        // Specific from a form
        $questions = Question::where("form_id", $input['formId']);

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
            $questions = $questions->orderBy('id', to_boolean($input['orderBy'])?'asc':'desc');
        }
        else {
            $questions = $questions->orderBy('id', 'asc');
        }

        // Obtain result
        $questions = $questions->paginate($input['perPage']);

        return $questions;
    }

    public static function createQuestion($input) {
        $input['hidden'] = to_boolean($input['hidden']);
        $input['blocked'] = to_boolean($input['blocked']);

        return Question::create([
            'field_id' => $input['fieldId'],
            'form_id' => $input['formId'],
            'hidden' => $input['hidden'],
            'blocked' => $input['blocked']
        ]);
    }

    public static function updateQuestion($question, $input) {
        if (isset($input['hidden'])) {
            $input['hidden'] = to_boolean($input['hidden']);
            $question->hidden = $input['hidden'];
        }
        if (isset($input['blocked'])) {
            $input['blocked'] = to_boolean($input['blocked']);
            $question->blocked = $input['blocked'];
        }
        if (isset($input['fieldId'])) {
            $question->field_id = $input['fieldId'];
        }
        if (isset($input['formId'])) {
            $question->form_id = $input['formId'];
        }
        $question->save();
        return $question;
    }

}