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
    public function index(Request $request)
    {
        $solicitudes = Solicitude::with(["form"]);

        if ($request->has('period_id')) {
            $solicitudes = $solicitudes->where("period_id", $request->period_id);
        }
        
        if ($request->has('user_id')) {
            $solicitudes = $solicitudes->where("user_id", $request->user_id);
        }

        $solicitudes = $solicitudes->orderBy('id', 'desc');

        if ($request->has('paginated') && filter_var($request->paginated, FILTER_VALIDATE_BOOLEAN)) {
            if($request->has('perPage')) {
                $solicitudes = $solicitudes->paginate($request->perPage);
            }
            else {
                $solicitudes = $solicitudes->paginate(10);
            }
        }
        else {
            $request->merge(['page' => 1]);
            $solicitudes = $solicitudes->paginate(10000);
        }

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
