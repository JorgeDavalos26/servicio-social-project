<?php

namespace App\Helpers;

use App\Enums\TypesQuestion;
use App\Models\answer;
use App\Models\Question;
use App\Models\Solicitude;
use Illuminate\Support\Arr;

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

    public static function createBulkAnswers($input) {
        $solicitude = Solicitude::find($input['solicitudeId']);
        $period = $solicitude->period;
        $answers = [];
        
        foreach($input['answers'] as $questionAnswer) {
            $question = Question::find($questionAnswer['questionId']);
            $field = $question->field;
            $answerValue = $questionAnswer['answer'];
            $value = "";

            if ($field->type == TypesQuestion::FILE->value) {
                $file = base64ToUploadedFile($answerValue);
                $value = storage()->storeMedia($file, 'local_custom', $period->label);
            }
            else if ($field->type == TypesQuestion::MULTIPLE_FILE->value) {
                foreach ($answerValue as $v) {
                    $file = base64ToUploadedFile($v);
                    $value .= storage()->storeMedia($file, 'local_custom', $period->label) . "|";
                }
            }
            else {
                $value = $answerValue;
            }

            $answers[] = Answer::create([
                'question_id' => $question->id,
                'solicitude_id' => $solicitude->id,
                'value' => $value,
            ]);
        }
        return $answers;
    }

    public static function updateMediaAnswer($answer, Array $files) {
        $period = $answer->solicitude->period;
        $field = $answer->question->field;
        $answerValue = "";

        if ($field->type == TypesQuestion::FILE) {
            $file = Arr::first($files);
            $path = storage()->storeMedia($file, 'local_custom', $period->label);
            $answerValue = $path;
        } 
        else if ($field->type == TypesQuestion::MULTIPLE_FILE) {
            foreach ($files as $file) {
                $path = storage()->storeMedia($file, 'local_custom', $period->label);
                $answerValue .= $path . "|";
            }
        }

        $answer->value = $answerValue;
        $answer->save();
        return $answer;
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