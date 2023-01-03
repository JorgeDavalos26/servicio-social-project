<?php

namespace App\Http\Controllers;

use App\Helpers\SettingHelper;
use App\Http\Requests\SettingGetRequest;
use App\Http\Requests\SettingPostRequest;
use App\Http\Requests\SettingPutBulkRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Http\Resources\SettingCollection;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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

    // BY SETTINGS SERVICE -------------------------------------------------------------------------------
    // Active Periods

    public function getActivePeriods(SettingsService $setting) {
        $activePeriods = $setting->getActivePeriods();
        return response()->success($activePeriods);
    }

    public function updateActivePeriods(SettingsService $setting, SettingPutBulkRequest $request) {
        $input = $request->validated();
        $activePeriods = $setting->updateActivePeriods($input['input']);
        return response()->success($activePeriods);
    }

    // Active Forms

    public function getActiveForms(SettingsService $setting) {
        $activeForms = $setting->getActiveForms();
        return response()->success($activeForms);
    }

    public function updateActiveForms(SettingsService $setting, SettingPutBulkRequest $request) {
        $input = $request->validated();
        $activeForms = $setting->updateActiveForms($input['input']);
        return response()->success($activeForms);
    }

    // Receive Upcoming Solicitudes

    public function getReceiveUpcomingSolicitudes(SettingsService $setting) {
        $upcomingSolicitudes = $setting->getActivePeriods();
        return response()->success($upcomingSolicitudes);
    }

    public function updateReceiveUpcomingSolicitudes(SettingsService $setting, SettingPutBulkRequest $request) {
        $input = $request->validated();
        $upcomingSolicitudes = $setting->updateReceiveUpcomingSolicitudes($input['input']);
        return response()->success($upcomingSolicitudes);
    }

}
