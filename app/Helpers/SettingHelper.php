<?php

namespace App\Helpers;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use App\Enums\SolicitudeStatus;
use App\Models\Setting;
use App\Models\Solicitude;

class SettingHelper
{

    public static function getSettings(&$input)
    {
        $settings = Setting::query();

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
            $settings = $settings->orderBy('id', to_boolean($input['orderBy']) ? 'asc' : 'desc');
        } else {
            $settings = $settings->orderBy('id', 'desc');
        }

        // Obtain result
        $settings = $settings->paginate($input['perPage']);

        return $settings;
    }

    public static function createSetting($input)
    {
        if (!isset($input['description'])) {
            $input['description'] = "";
        }
        return Setting::create([
            'key' => $input['key'],
            'value' => $input['value'],
            'description' => $input['description'],
        ]);
    }

    public static function updateSetting($setting, $input)
    {
        if (isset($input['key'])) $setting->key = $input['key'];
        if (isset($input['value'])) $setting->value = $input['value'];
        if (isset($input["description"])) $setting->description = $input["description"];
        $setting->save();
        return $setting;
    }

    /* private static function getPeriodIdGivenScholarTerms($scholarLevel, $scholarCourse) {
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
    } */

    public static function getActiveFormsIds(): array
    {
        $ids = [];

        foreach (settings()->getActiveForms() as $activeForm) {
            $ids[] = $activeForm->value;
        }

        return $ids;
    }

}
