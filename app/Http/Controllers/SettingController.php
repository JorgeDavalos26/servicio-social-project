<?php

namespace App\Http\Controllers;

use App\Helpers\SettingHelper;
use App\Http\Requests\SettingGetRequest;
use App\Http\Requests\SettingPostRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Http\Resources\SettingCollection;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use App\Services\GlobalSettingsService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(SettingGetRequest $request)
    {
        $input = $request->validated();
        $settings = SettingHelper::getSettings($input);
        $additionalData = [
            "paginationTotalItems" => $settings->total(),
            "paginationPerPage" => (int)$input['perPage'],
            "paginationPage" => (int)$input['page']
        ];
        return response()->success(new SettingCollection($settings), $additionalData);
    }

    public function show(Setting $setting)
    {
        return response()->success(new SettingResource($setting));
    }

    public function store(SettingPostRequest $request)
    {
        $input = $request->validated();
        $newSetting = SettingHelper::createSetting($input);
        return response()->success(new SettingResource($newSetting));
    }

    public function update(Setting $setting, SettingUpdateRequest $request)
    {
        $input = $request->validated();
        $setting = SettingHelper::updateSetting($setting, $input);
        return response()->success(new SettingResource($setting));
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return response()->success(new SettingResource($setting));
    }

    // -------------------------------------------------------------------------------
    // Active Periods

    public function getActivePeriods(GlobalSettingsService $globalSetting) {
        $activePeriods = $globalSetting->getActivePeriods();
        return response()->success($activePeriods);
    }

    public function updateActivePeriods(GlobalSettingsService $globalSetting, Array $input) {
        $activePeriods = $globalSetting->updateActivePeriods($input);
        return response()->success($activePeriods);

        /* $periods = [];
        foreach ($input as $period) $periods[] = self::updateActivePeriod($period);
        return $periods; */
    }

    // Active Forms

    public function getActiveForms(GlobalSettingsService $globalSetting) {
        $activeForms = $globalSetting->getActiveForms();
        return response()->success($activeForms);
    }

    public function updateActiveForms(GlobalSettingsService $globalSetting, Array $input) {
        $activeForms = $globalSetting->updateActiveForms($input);
        return response()->success($activeForms);

        /* $forms = [];
        foreach ($input as $form) $forms[] = self::updateActiveForm($form); 
        return $forms; */
    }

    // Receive Upcoming Solicitudes

    public function getReceiveUpcomingSolicitudes(GlobalSettingsService $globalSetting) {
        $upcomingSolicitudes = $globalSetting->getActivePeriods();
        return response()->success($upcomingSolicitudes);
    }

    public function updateReceiveUpcomingSolicitudes(GlobalSettingsService $globalSetting, Array $input) {
        
        $upcomingSolicitudes = $globalSetting->updateReceiveUpcomingSolicitudes($input);
        return response()->success($upcomingSolicitudes);
        
        /* $solicitudes = [];
        foreach ($input as $solicitude) $solicitudes[] = self::updateReceiveUpcomingSolicitude($solicitude);  
        return $solicitudes; */
    }


}
