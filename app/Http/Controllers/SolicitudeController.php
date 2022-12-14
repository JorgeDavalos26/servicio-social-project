<?php

namespace App\Http\Controllers;

use App\Http\Resources\SolicitudeCollection;
use App\Http\Resources\SolicitudeResource;
use App\Models\Solicitude;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SolicitudeController extends Controller
{
    public function index()
    {
        if (request()->has('paginated')) {
            $paginated = request()->input('paginated');
            $paginated = filter_var($paginated, FILTER_VALIDATE_BOOLEAN);
            if($paginated) {
                $solicitudes = Solicitude::with(["form"])->orderBy('id', 'desc')->paginate(2);
                return response()->success(new SolicitudeCollection($solicitudes));
            }
        }
        $solicitudes = Solicitude::with(["form"])->orderBy('id', 'desc')->get();
        return response()->success(SolicitudeResource::collection($solicitudes));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => ['required'],
            'formId' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->error('Datos Inválidos');
        }

        $newSolicitude = Solicitude::create([
            'user_id' => $request->userId,
            'form_id' => $request->formId,
        ]);

        return response()->success(new SolicitudeResource($newSolicitude));
    }

    public function update(Solicitude $solicitude, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => ['required'],
            'formId' => ['required'],
            'status' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->error('Datos Inválidos');
        }

        $solicitude->user_id = $request->userId;
        $solicitude->form_id = $request->formId;
        $solicitude->status = $request->status;
        $solicitude->save();

        return response()->success(new SolicitudeResource($solicitude));
    }

    public function destroy(Solicitude $solicitude)
    {
        $res = $solicitude->delete();
        return response()->success($res);
    }

}
