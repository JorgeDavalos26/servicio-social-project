<?php

namespace App\Helpers;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use App\Enums\SolicitudeStatus;
use App\Models\Answer;
use App\Models\Field;
use App\Models\Form;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Solicitude;
use Illuminate\Support\Facades\Auth;

class SolicitudeHelper
{

    public static function getSolicitudes(&$input)
    {
        $solicitudes = Solicitude::with(["form"]);

        // Specific from a Period
        if (isset($input['periodId'])) {
            $solicitudes = $solicitudes->where("period_id", $input['periodId']);
        } else if (isset($input['scholarLevel']) && isset($input['scholarCourse'])) {
            $periodId = PeriodHelper::getPeriodIdGivenScholarTerms($input['scholarLevel'], $input['scholarCourse']);
            $solicitudes = $solicitudes->where("period_id", $periodId);
        }

        // Specific from a User
        if (isset($input['userId'])) {
            $solicitudes = $solicitudes->where("user_id", $input['userId']);
        }

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
            $solicitudes = $solicitudes->orderBy('id', to_boolean($input['orderBy']) ? 'asc' : 'desc');
        } else {
            $solicitudes = $solicitudes->orderBy('id', 'desc');
        }

        // Obtain result
        $solicitudes = $solicitudes->paginate($input['perPage']);

        return $solicitudes;
    }

    public static function createSolicitude($input)
    {
        if (isset($input['scholarLevel']) && isset($input['scholarCourse'])) {
            $periodId = PeriodHelper::getPeriodIdGivenScholarTerms($input['scholarLevel'], $input['scholarCourse']);
            $input['periodId'] = $periodId;
        }
        if (!isset($input['status'])) {
            $input['status'] = SolicitudeStatus::NEW;
        }
        return Solicitude::create([
            'user_id' => $input['userId'],
            'form_id' => $input['formId'],
            'period_id' => $input['periodId'],
            'status' => $input['status'],
        ]);
    }

    public static function updateSolicitude($solicitude, $input)
    {
        $solicitude->status = $input['status'];
        $solicitude->save();
        return $solicitude;
    }

    public static function isAuthenticatedUserSolicitudesOwner(int $solicitudeId): bool
    {
        $solicitude = Solicitude::where('id', $solicitudeId)->first();

        if ($solicitude == null) return false;

        return $solicitude['user_id'] == Auth::user()->id;
    }

    public static function getSolicitudeWithQuestionsAndAnswers(int $solicitudeId): ?array
    {
        $solicitude = Solicitude::with(['form', 'period'])
            ->where('id', $solicitudeId)
            ->first();

        if (!$solicitude) return null;

        $toReturn = [
            'solicitudeId' => $solicitudeId,
            'status' => $solicitude['status'],
            'periodLabel' => $solicitude['period']['label'],
            'questions' => []
        ];

        $questions = Question::with(['field'])
            ->where('form_id', $solicitude['form']['id'])
            ->get();

        foreach ($questions as $question) {
            $answer = Answer::where('question_id', $question['id'])
                ->where('solicitude_id', $solicitudeId)
                ->first();

            $toReturn['questions'][] = [
                    'id' => $question['id'],
                    'hidden' => $question['hidden'],
                    'blocked' => $question['blocked'],
                    'backendName' => $question['field']['backend_name'],
                    'frontendName' => $question['field']['frontend_name'],
                    'type' => $question['field']['type']
                ] + ($answer ? ['answer' => [
                    'id' => $answer['id'],
                    'value' => $answer['value']
                ]] : []);
        }

        return $toReturn;
    }

}
