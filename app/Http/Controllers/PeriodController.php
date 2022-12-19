<?php

namespace App\Http\Controllers;

use App\Helpers\PeriodHelper;
use App\Http\Requests\PeriodGetRequest;
use App\Http\Requests\PeriodPostRequest;
use App\Http\Requests\PeriodUpdateRequest;
use App\Http\Resources\PeriodCollection;
use App\Http\Resources\PeriodResource;
use App\Models\Period;
use App\Models\Setting;

class PeriodController extends Controller
{
    public function index(PeriodGetRequest $request)
    {
        $settings = Setting::where('key', 'like', '%PERIODS.%')->get();
        $additionalData = [
            "active_periods" => $settings
        ];
        $periods = PeriodHelper::getPeriods($request);
        return response()->success(new PeriodCollection($periods), $additionalData);
    }
    
    public function show(Period $period)
    {
        $settings = Setting::where('key', 'like', '%PERIODS.%')->get();
        $additionalData = [
            $settings
        ];
        return response()->success(new PeriodResource($period), $additionalData);
    }

    public function store(PeriodPostRequest $request)
    {
        $newPeriod = PeriodHelper::createPeriod($request);
        return response()->success(new PeriodResource($newPeriod));
    }

    public function update(PeriodUpdateRequest $request, Period $period)
    {
        $period = PeriodHelper::updatePeriod($period, $request);
        return response()->success(new PeriodResource($period));
    }

    public function destroy(Period $period)
    {
        $period->delete();
        return response()->success(new PeriodResource($period));
    }
}
