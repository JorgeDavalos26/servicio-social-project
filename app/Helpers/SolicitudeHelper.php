<?php

namespace App\Helpers;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use App\Enums\SolicitudeStatus;
use App\Models\Setting;
use App\Models\Solicitude;

class SolicitudeHelper {

    public static function getSolicitudes(&$input) {
        $solicitudes = Solicitude::with(["form"]);

        // Specific from a Period
        if (isset($input['periodId'])) {
            $solicitudes = $solicitudes->where("period_id", $input['periodId']);
        }
        else if (isset($input['scholarLevel']) && isset($input['scholarCourse'])) {
            $periodId = SolicitudeHelper::getPeriodIdGivenScholarTerms($input['scholarLevel'], $input['scholarCourse']);
            $solicitudes = $solicitudes->where("period_id", $periodId);
        }
        
        // Specific from a User
        if (isset($input['userId'])) {
            $solicitudes = $solicitudes->where("user_id", $input['userId']);
        }

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
            $solicitudes = $solicitudes->orderBy('id', to_boolean($input['orderBy'])?'asc':'desc');
        }
        else {
            $solicitudes = $solicitudes->orderBy('id', 'desc');
        }

        // Obtain result
        $solicitudes = $solicitudes->paginate($input['perPage']);

        return $solicitudes;
    }

    public static function createSolicitude($input) {
        if (isset($input['scholarLevel']) && isset($input['scholarCourse'])) {
            $periodId = SolicitudeHelper::getPeriodIdGivenScholarTerms($input['scholarLevel'], $input['scholarCourse']);
            $input['periodId'] = $periodId;
        }
        return Solicitude::create([
            'user_id' => $input['userId'],
            'form_id' => $input['formId'],
            'period_id' => $input['periodId'],
            'status' => isset($input['status'])?$input['status']:SolicitudeStatus::NEW,
        ]);
    }

    public static function updateSolicitude($solicitude, $input) {
        $solicitude->status = $input['status'];
        $solicitude->save();
        return $solicitude;
    }

    private static function getPeriodIdGivenScholarTerms($scholarLevel, $scholarCourse) {
        $key = "";

        foreach(ScholarLevel::cases() as $case)
            if($case->value == $scholarLevel)
                $key .= $case->name;

        $key .= "_";
        
        foreach(ScholarCourse::cases() as $case)
            if($case->value == $scholarCourse)
                $key .= $case->name;
        
        $periodId = Setting::where("key", "PERIODS." . $key . ".ACTIVE_ID_PERIOD")->first()->value;

        return $periodId;
    }

}