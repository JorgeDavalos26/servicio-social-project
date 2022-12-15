<?php

namespace App\Http\Controllers;

use App\Enums\SolicitudeStatus;
use App\Http\Resources\SolicitudeCollection;
use App\Http\Resources\SolicitudeResource;
use App\Models\Solicitude;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SolicitudeController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitude::with(["form"])->orderBy('id', 'desc');

        if (request()->has('paginated') && filter_var(request()->input('paginated'), FILTER_VALIDATE_BOOLEAN)) {
            if(request()->has('perPage')) {
                $solicitudes = $solicitudes->paginate(request()->input('perPage'));
            }
            else {
                $solicitudes = $solicitudes->paginate(10);
            }
        }
        else {
            request()->merge(['page' => 1]);
            $solicitudes = $solicitudes->paginate(10000);
        }

        return response()->success(new SolicitudeCollection($solicitudes), ["total" => $solicitudes->total()]);
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

        $newSolicitude = Solicitude::create([
            'user_id' => $request->userId,
            'form_id' => $request->formId,
            'period_id' => $request->periodId,
            'status' => $request->status
        ]);

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

        $solicitude->user_id = $request->userId;
        $solicitude->form_id = $request->formId;
        $solicitude->period_id = $request->periodId;
        $solicitude->status = $request->status;
        $solicitude->save();

        return response()->success(new SolicitudeResource($solicitude));
    }

    public function destroy(Solicitude $solicitude)
    {
        $solicitude->delete();
        return response()->success(new SolicitudeResource($solicitude));
    }

}
