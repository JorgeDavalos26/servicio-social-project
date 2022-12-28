<?php

namespace App\Http\Controllers;

use App\Helpers\SolicitudeHelper;
use App\Http\Requests\SolicitudesGetRequest;
use App\Http\Requests\SolicitudesPostRequest;
use App\Http\Requests\SolicitudesUpdateRequest;
use App\Http\Resources\SolicitudeCollection;
use App\Http\Resources\SolicitudeCompleteResource;
use App\Http\Resources\SolicitudeResource;
use App\Models\Solicitude;
use Illuminate\Support\Facades\Auth;

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
        if (!Auth::check()) {
            return response()->error("Must be authenticated", null, 401);
        }

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

    public function getComplete(Solicitude $solicitude) {
        if (!Auth::check()) return response()->error("Must be authenticated", null, 401);
        if ($solicitude == null) return response()->error("Only solicitude owner can access it", null, 401);
        return response()->success(new SolicitudeCompleteResource($solicitude));
    }

    public static function getSolicitudesOfStudent(int $studentId): SolicitudeCollection
    {
        $solicitudes = Solicitude::with(['form'])
            ->where('user_id', $studentId)
            ->get();

        return new SolicitudeCollection($solicitudes);
    }

}
