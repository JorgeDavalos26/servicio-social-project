<?php

namespace App\Helpers;

use App\Enums\ScholarCourse;
use App\Enums\ScholarLevel;
use App\Enums\SolicitudeStatus;
use App\Models\Setting;
use App\Models\Solicitude;
use Illuminate\Support\Facades\Auth;

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
        $userId = Auth::user()->id;
        $periodsIds = [];

        if (Setting::where('key', 'SOLICITUDES.TECNOLOGO_PROPEDEUTICO.RECEIVE_UPCOMING')
            ->where('value', '1')
            ->exists()) {
            $periodId = Setting::firstWhere("key", 'FORMS.TECNOLOGO_PROPEDEUTICO.ACTIVE_ID_FORM')
                ->value;

            if (!Solicitude::where('user_id', $userId)->where('period_id', $periodId)->exists()) {
                $periodsIds[] = $periodId;
            }
        }

        if (Setting::where('key', 'SOLICITUDES.INGENIERIA_PROPEDEUTICO.RECEIVE_UPCOMING')
            ->where('value', '1')
            ->exists()) {
            $periodId = Setting::firstWhere("key", 'FORMS.INGENIERIA_PROPEDEUTICO.ACTIVE_ID_FORM')
                ->value;

            if (!Solicitude::where('user_id', $userId)->where('period_id', $periodId)->exists()) {
                $periodsIds[] = $periodId;
            }
        }

        if (Setting::where('key', 'SOLICITUDES.TECNOLOGO_NIVELACION.RECEIVE_UPCOMING')
            ->where('value', '1')
            ->exists()) {
            $periodId = Setting::firstWhere("key", 'FORMS.TECNOLOGO_NIVELACION.ACTIVE_ID_FORM')
                ->value;

            if (!Solicitude::where('user_id', $userId)->where('period_id', $periodId)->exists()) {
                $periodsIds[] = $periodId;
            }
        }

        if (Setting::where('key', 'SOLICITUDES.INGENIERIA_NIVELACION.RECEIVE_UPCOMING')
            ->where('value', '1')
            ->exists()) {
            $periodId = Setting::firstWhere("key", 'FORMS.INGENIERIA_NIVELACION.ACTIVE_ID_FORM')
                ->value;

            if (!Solicitude::where('user_id', $userId)->where('period_id', $periodId)->exists()) {
                $periodsIds[] = $periodId;
            }
        }

        return $periodsIds;
    }

}
