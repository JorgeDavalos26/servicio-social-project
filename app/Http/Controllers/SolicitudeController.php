<?php

namespace App\Http\Controllers;

use App\Helpers\GroupHelper;
use App\Helpers\SolicitudeHelper;
use App\Http\Requests\SolicitudesGetRequest;
use App\Http\Requests\SolicitudesPostRequest;
use App\Http\Requests\SolicitudesUpdateRequest;
use App\Http\Resources\SolicitudeCollection;
use App\Http\Resources\SolicitudeCompleteResource;
use App\Http\Resources\SolicitudeResource;
use App\Models\Solicitude;
use App\Policies\SolicitudePolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

        if ($newSolicitude == null) return response()->error("Form not found", 404);

        return response()->success(new SolicitudeResource($newSolicitude));
    }

    public function update(Solicitude $solicitude, SolicitudesUpdateRequest $request)
    {
        $input = $request->validated();
        $solicitude = SolicitudeHelper::updateSolicitude($solicitude, $input);
        return response()->success(new SolicitudeResource($solicitude));
    }

    public function updateToWaitingPayment(Solicitude $solicitude)
    {
        $updatedSolicitude = SolicitudeHelper::updateSolicitudeToWaitingForPayment($solicitude);
        if ($updatedSolicitude == null) return response()->error("Solicitude not completely answered", 400);

        $updatedSolicitude = GroupHelper::addSolicitudeToGroup($updatedSolicitude);

        return response()->success(new SolicitudeResource($updatedSolicitude));
    }

    public function confirmPayment(Solicitude $solicitude)
    {
        $updatedSolicitude = SolicitudeHelper::confirmPayment($solicitude);
        if ($updatedSolicitude == null) return response()->error("Solicitude not available for payment confirm", 400);

        return response()->success(new SolicitudeResource($updatedSolicitude));
    }

    public function destroy(Solicitude $solicitude)
    {
        $solicitude->delete();
        return response()->success(new SolicitudeResource($solicitude));
    }

    public function getComplete(Solicitude $solicitude)
    {
        return response()->success(new SolicitudeCompleteResource($solicitude));
    }

    public static function getSolicitudesOfStudent(int $studentId): SolicitudeCollection
    {
        $solicitudes = Solicitude::with(['form', 'period'])
            ->where('user_id', $studentId)
            ->get();

        return new SolicitudeCollection($solicitudes);
    }

}
