<?php

namespace App\Http\Controllers;

use App\Helpers\SolicitudeHelper;
use App\Http\Requests\SolicitudesGetRequest;
use App\Http\Requests\SolicitudesPostRequest;
use App\Http\Requests\SolicitudesUpdateRequest;
use App\Http\Resources\SolicitudeCollection;
use App\Http\Resources\SolicitudeResource;
use App\Models\Solicitude;

class SolicitudeController extends Controller
{
    public function index(SolicitudesGetRequest $request)
    {
        $solicitudes = SolicitudeHelper::getSolicitudes($request);

        $additionalData = [
            "pagination:total_items" => $solicitudes->total(),
            "pagination:per_page" => (int)$request->perPage,
            "pagination:page" => (int)$request->page
        ];

        return response()->success(new SolicitudeCollection($solicitudes), $additionalData);
    }

    public function show(Solicitude $solicitude)
    {
        return response()->success(new SolicitudeResource($solicitude));
    }

    public function store(SolicitudesPostRequest $request)
    {
        $newSolicitude = SolicitudeHelper::createSolicitude($request);
        return response()->success(new SolicitudeResource($newSolicitude));
    }

    public function update(Solicitude $solicitude, SolicitudesUpdateRequest $request)
    {
        $solicitude = SolicitudeHelper::updateSolicitude($solicitude, $request);
        return response()->success(new SolicitudeResource($solicitude));
    }

    public function destroy(Solicitude $solicitude)
    {
        $solicitude->delete();
        return response()->success(new SolicitudeResource($solicitude));
    }

}
