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
        $input = $request->validated(); // returns JUST the data already validated
        $solicitudes = SolicitudeHelper::getSolicitudes($input);
        $additionalData = [
            "paginationTotalItems" => $solicitudes->total(),
            "paginationPerPage" => (int)$input['perPage'],
            "paginationPage" => (int)$input['page']
        ];
        return response()->success(new SolicitudeCollection($solicitudes), $additionalData);
    }

    public function show(Solicitude $solicitude)
    {
        return response()->success(new SolicitudeResource($solicitude));
    }

    public function store(SolicitudesPostRequest $request)
    {
        $input = $request->validated();
        $newSolicitude = SolicitudeHelper::createSolicitude($input);
        return response()->success(new SolicitudeResource($newSolicitude));
    }

    public function update(Solicitude $solicitude, SolicitudesUpdateRequest $request)
    {
        $input = $request->validated();
        $solicitude = SolicitudeHelper::updateSolicitude($solicitude, $input);
        return response()->success(new SolicitudeResource($solicitude));
    }

    public function destroy(Solicitude $solicitude)
    {
        $solicitude->delete();
        return response()->success(new SolicitudeResource($solicitude));
    }

}
