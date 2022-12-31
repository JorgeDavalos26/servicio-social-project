<?php

namespace App\Helpers;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use App\Models\Period;
use App\Models\Setting;

class PeriodHelper {

    public static function getPeriods(&$input) {
        $periods = Period::query();

        // Specific from greater or less than a date
        if (isset($input['startDate'])) {
            $periods = $periods->where('start_date', '>=', $input['startDate']);
        }
        if (isset($input['endDate'])) {
            $periods = $periods->where('end_date', '<=', $input['endDate']);
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
            $periods = $periods->orderBy('id', to_boolean($input['orderBy'])?'asc':'desc');
        }
        else {
            $periods = $periods->orderBy('id', 'desc');
        }

        // Obtain result
        $periods = $periods->paginate($input['perPage']);

        return $periods;
    }

    public static function createPeriod($input) {
        return Period::create([
            'start_date' => $input['startDate'],
            'end_date' => $input['endDate'],
            'label' => $input['label'],
        ]);
    }

    public static function updatePeriod($period, $input) {
        if (isset($input['startDate'])) {
            $period->start_date = $input['startDate'];
        }
        if (isset($input['endDate'])) {
            $period->end_date = $input['endDate'];
        }
        if (isset($input['label'])) {
            $period->label = $input['label'];
        }
        $period->save();
        return $period;
    }

    public static function getPeriodIdGivenScholarTerms($scholarLevel, $scholarCourse) {
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
