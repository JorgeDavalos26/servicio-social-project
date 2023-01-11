<?php

namespace App\Helpers;

use App\Enums\SolicitudeStatus;
use App\Exceptions\EmailAttachmentCustomException;
use App\Helpers\MailHelper as HelpersMailHelper;
use App\Http\Resources\SolicitudeCollection;
use App\Models\Answer;
use App\Models\Form;
use App\Models\Question;
use App\Models\Solicitude;
use Illuminate\Support\Facades\Auth;

class SolicitudeHelper
{

    public static function getSolicitudes(&$input)
    {
        $solicitudes = Solicitude::with(["form", 'period']);

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

        // Specific status
        if (isset($input['status'])) {
            $solicitudes = $solicitudes->where("status", $input['status']);
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
        $form = Form::find($input['formId']);

        if (!$form) return null;

        $periodId = PeriodHelper::getPeriodIdGivenScholarTerms($form->scholar_level, $form->scholar_course);
        $input['periodId'] = $periodId;

        if (!isset($input['userId'])) {
            $input['userId'] = Auth::user()->id;
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

    public static function updateSolicitudeToWaitingForPayment(Solicitude $solicitude): ?Solicitude
    {
        if (user()->getUser()->id != $solicitude['user_id'] || !self::isSolicitudeCompletelyAnswered($solicitude)) {
            return null;
        }

        $solicitude->status = SolicitudeStatus::WAITING_PAYMENT;
        $solicitude->save();

        return $solicitude;
    }

    public static function confirmPayment(Solicitude $solicitude): ?Solicitude
    {
        if ((!user()->isSupport() && !user()->isAdmin()) || $solicitude->status != SolicitudeStatus::WAITING_PAYMENT) {
            return null;
        }

        $solicitude->status = SolicitudeStatus::PAYMENT_REGISTERED;
        $solicitude->save();

        return $solicitude;
    }

    public static function isSolicitudeCompletelyAnswered(Solicitude $solicitude): bool
    {
        $questionsRequiredOfForm = Question::where('form_id', $solicitude['form_id'])
            ->where('required', true)
            ->get();

        $allAnswered = true;

        foreach ($questionsRequiredOfForm as $question) {
            $answer = Answer::where('question_id', $question['id'])
                ->where('solicitude_id', $solicitude['id'])
                ->where('value', '<>', '')
                ->first();

            if ($answer == null) {
                $allAnswered = false;
                break;
            }
        }

        return $allAnswered;
    }

    public static function sendEmailTo(int $solicitudeId): void
    {
        $solicitude = Solicitude::with(['user', 'form', 'group'])->find($solicitudeId);
        $grNameExploded = explode("_", $solicitude->group->name);
        try {
            HelpersMailHelper::sendFormCompletedMail([
                'to' => $solicitude->user->email,
                'level' => $solicitude->form->scholar_level,
                'course' => $solicitude->form->scholar_course,
                'group_name' => $grNameExploded[array_key_last($grNameExploded)]
            ]);
        } catch (EmailAttachmentCustomException $e) {
            // TODO: Log email sending error, show it on a new admin view so it can be manually reattempted
        }
    }

    public static function getSolicitudesOfStudent(int $studentId): SolicitudeCollection
    {
        $solicitudes = Solicitude::with(['form', 'period'])
            ->where('user_id', $studentId)
            ->get();
        return new SolicitudeCollection($solicitudes);
    }
}
