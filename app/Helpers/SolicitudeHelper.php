<?php

namespace App\Helpers;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use App\Models\Setting;
use App\Models\Solicitude;

class SolicitudeHelper {

    public static function getSolicitudes($request) {
        $solicitudes = Solicitude::with(["form"]);

        if ($request->has('period_id')) {
            $solicitudes = $solicitudes->where("period_id", $request->period_id);
        }

        if ($request->has('scholar_level') && $request->has('scholar_course')) {
            
            $key = "";

            foreach(ScholarLevel::cases() as $case) {
                if($case->value == $request->scholar_level) {
                    $key .= $case->name;
                    break;
                }
            }

            $key .= "_";
            
            foreach(ScholarCourse::cases() as $case) {
                if($case->value == $request->scholar_course) {
                    $key .= $case->name;
                    break;
                }
            }
           
            $periodId = Setting::where("key", "PERIODS." . $key . ".ACTIVE_ID_PERIOD")->first()->value;
            $solicitudes = $solicitudes->where("period_id", $periodId);
        }
        
        if ($request->has('user_id')) {
            $solicitudes = $solicitudes->where("user_id", $request->user_id);
        }

        $solicitudes = $solicitudes->orderBy('id', 'desc');

        if ($request->has('paginated') && filter_var($request->paginated, FILTER_VALIDATE_BOOLEAN)) {
            if($request->has('perPage')) {
                $solicitudes = $solicitudes->paginate($request->perPage);
            }
            else {
                $solicitudes = $solicitudes->paginate(10);
            }
        }
        else {
            $request->merge(['page' => 1]);
            $solicitudes = $solicitudes->paginate(10000);
        }

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