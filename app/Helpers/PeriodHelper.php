<?php

namespace App\Helpers;

use App\Models\Period;

class PeriodHelper {

    public static function getPeriods($request) {
        $periods = Period::get();

        /* if ($request->has('period_id')) {
            $periods = $periods->where("period_id", $request->period_id);
        }
        
        if ($request->has('user_id')) {
            $periods = $periods->where("user_id", $request->user_id);
        }

        $periods = $periods->orderBy('id', 'desc');

        if ($request->has('paginated') && filter_var($request->paginated, FILTER_VALIDATE_BOOLEAN)) {
            if($request->has('perPage')) {
                $periods = $periods->paginate($request->perPage);
            }
            else {
                $periods = $periods->paginate(10);
            }
        }
        else {
            $request->merge(['page' => 1]);
            $periods = $periods->paginate(10000);
        } */

        return $periods;
    }

    public static function createPeriod($request) {
        return Period::create([
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'label' => $request->label,
        ]);
    }

    public static function updatePeriod($period, $request) {
        $period->start_date = $request->startDate;
        $period->end_date = $request->endDate;
        $period->label = $request->label;
        $period->save();
        return $period;
    }

}