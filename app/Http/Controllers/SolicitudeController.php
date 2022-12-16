<?php

namespace App\Http\Controllers;

use App\Enums\SolicitudeStatus;
use App\Helpers\SolicitudeHelper;
use App\Http\Resources\SolicitudeCollection;
use App\Http\Resources\SolicitudeResource;
use App\Models\Solicitude;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SolicitudeController extends Controller
{
    public function index(Request $request)
    {
        $solicitudes = SolicitudeHelper::getSolicitudes($request);
        return response()->success(new SolicitudeCollection($solicitudes), ["total" => $solicitudes->total()]);
    }

    public function show(Solicitude $solicitude)
    {
        return response()->success(new SolicitudeResource($solicitude));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => ['required'],
            'formId' => ['required'],
            'periodId' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->error('Datos Inválidos');
        }

        $newSolicitude = SolicitudeHelper::createSolicitude($request);
        return response()->success(new SolicitudeResource($newSolicitude));
    }

    public function update(Solicitude $solicitude, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => ['required'],
            'formId' => ['required'],
            'periodId' => ['required'],
            'status' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->error('Datos Inválidos');
        }

        $solicitude = SolicitudeHelper::updateSolicitude($solicitude, $request);
        return response()->success(new SolicitudeResource($solicitude));
    }

    public function destroy(Solicitude $solicitude)
    {
        $solicitude->delete();
        return response()->success(new SolicitudeResource($solicitude));
    }

}
