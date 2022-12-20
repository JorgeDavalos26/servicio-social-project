<?php

namespace App\Helpers;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use App\Models\Setting;
use App\Models\Solicitude;

class SolicitudeHelper {

    public static function getSolicitudes($request) {
        $solicitudes = Solicitude::with(["form"]);

        // Specific from a Period
        if ($request->has('period_id')) {
            $solicitudes = $solicitudes->where("period_id", $request->period_id);
        }
        else if ($request->has('scholar_level') && $request->has('scholar_course')) {
            $key = "";

            foreach(ScholarLevel::cases() as $case)
                if($case->value == $request->scholar_level)
                    $key .= $case->name;

            $key .= "_";
            
            foreach(ScholarCourse::cases() as $case)
                if($case->value == $request->scholar_course)
                    $key .= $case->name;
           
            $periodId = Setting::where("key", "PERIODS." . $key . ".ACTIVE_ID_PERIOD")->first()->value;
            $solicitudes = $solicitudes->where("period_id", $periodId);
        }
        
        // Specific from a User
        if ($request->has('user_id')) {
            $solicitudes = $solicitudes->where("user_id", $request->user_id);
        }

        // Pagination
        if ($request->has('paginated') && filter_var($request->paginated, FILTER_VALIDATE_BOOLEAN)) {
            if(!$request->has('perPage')) $request->merge(['perPage' => 10]);
        }
        else {
            $request->merge(['page' => 1]);
            $request->merge(['perPage' => 100000]);
        }

        // Obtain result
        $solicitudes = $solicitudes->orderBy('id', 'desc')->paginate($request->perPage);

        return $solicitudes;
    }

    public static function createSolicitude($request) {
        return Solicitude::create([
            'user_id' => $request->userId,
            'form_id' => $request->formId,
            'period_id' => $request->periodId,
            'status' => $request->status
        ]);
    }

    public static function updateSolicitude($solicitude, $request) {
        $solicitude->user_id = $request->userId;
        $solicitude->form_id = $request->formId;
        $solicitude->period_id = $request->periodId;
        $solicitude->status = $request->status;
        $solicitude->save();
        return $solicitude;
    }

}