<?php

namespace App\Helpers;

use App\Enums\TypesQuestion;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Solicitude;
use Illuminate\Support\Arr;

class AnswerHelper
{

    public static function getAnswers(&$input)
    {
        // Specific from a solicitude
        $answers = Answer::where("solicitude_id", $input['solicitudeId']);

        // Pagination
        if (isset($input['paginated']) && to_boolean($input['paginated'])) {
            if (!isset($input['perPage'])) $input['perPage'] = 10;
            if (!isset($input['page'])) $input['page'] = 1;
        } else {
            $input['page'] = 1;
            $input['perPage'] = 100000;
        }

        // OrderBy
        if (isset($input['orderBy'])) {
            $answers = $answers->orderBy('id', to_boolean($input['orderBy']) ? 'asc' : 'desc');
        } else {
            $answers = $answers->orderBy('id', 'asc');
        }

        // Obtain result
        $answers = $answers->paginate($input['perPage']);

        return $answers;
    }

    public static function createAnswer($input)
    {
        return Answer::create([
            'question_id' => $input['questionId'],
            'solicitude_id' => $input['solicitudeId'],
            'value' => $input['value'],
        ]);
    }

    public static function createBulkAnswers($input)
    {
        $solicitude = Solicitude::find($input['solicitudeId']);
        $answers = [];

        foreach ($input['answers'] as $questionAnswer) {
            $question = Question::find($questionAnswer['questionId']);
            $field = $question->field;
            $answerValue = $questionAnswer['answer'];
//            if ($field->type == TypesQuestion::FILE->value) {
//                $file = base64ToUploadedFile($answerValue);
//                $value = storage()->storeMedia($file, 'local_custom', $period->label);
//            } else if ($field->type == TypesQuestion::MULTIPLE_FILE->value) {
//                foreach ($answerValue as $v) {
//                    $file = base64ToUploadedFile($v);
//                    $value .= storage()->storeMedia($file, 'local_custom', $period->label) . "|";
//                }
//            } else {
//                $value = $answerValue;
//            }

            if ($field->type == TypesQuestion::FILE || $field->type == TypesQuestion::MULTIPLE_FILE) {
                continue;
            }

            if ($field->type == TypesQuestion::BOOLEAN && $answerValue != "true" && $answerValue != "false") {
                continue;
            }

            if ($field->type == TypesQuestion::SELECT || $field->type == TypesQuestion::MULTIPLE) {
                $selected = explode("|", $answerValue);
                $allValuesValid = true;
                foreach ($selected as $selectValue) {
                    if (!str_contains($field->select_values, $selectValue)) {
                        $allValuesValid = false;
                        break;
                    }
                }

                if (!$allValuesValid) {
                    break;
                }
            }

            $answer = self::getAnswerWithSolicitudeIdAndQuestionId($solicitude->id, $question->id);

            $answer->value = $answerValue;
            $answer->save();

            $answers[] = $answer;
        }
        return $answers;
    }

    public static function updateMediaAnswer(Solicitude $solicitude, Question $question, array $files)
    {
        $period = $solicitude->period;
        $field = $question->field;
        $answerValue = "";

        if ($field->type == TypesQuestion::FILE) {
            $file = Arr::first($files);
            $path = storage()->storeMedia($file, 'local_custom', $period->label);
            $answerValue = $path;
        } else if ($field->type == TypesQuestion::MULTIPLE_FILE) {
            foreach ($files as $file) {
                $path = storage()->storeMedia($file, 'local_custom', $period->label);
                $answerValue .= $path . "|";
            }
        } else {
            return null;
        }

        $answer = self::getAnswerWithSolicitudeIdAndQuestionId($solicitude->id, $question->id);

        $answer->value = $answerValue;
        $answer->save();

        return $answer;
    }

    private static function getAnswerWithSolicitudeIdAndQuestionId($solicitudeId, $questionId)
    {
        $answer = Answer::where('question_id', $questionId)
            ->where('solicitude_id', $solicitudeId)
            ->first();

        if ($answer == null) {
            $answer = Answer::create([
                'question_id' => $questionId,
                'solicitude_id' => $solicitudeId,
                'value' => "",
            ]);
        }

        return $answer;
    }

    public static function updateAnswer($answer, $input)
    {
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
