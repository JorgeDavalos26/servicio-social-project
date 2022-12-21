<?php

namespace App\Http\Controllers;

use App\Helpers\FormHelper;
use App\Http\Requests\FormGetRequest;
use App\Http\Requests\FormPostRequest;
use App\Http\Requests\FormPutRequest;
use App\Http\Resources\FormCollection;
use App\Http\Resources\FormResource;
use App\Http\Resources\SolicitudeResource;
use App\Models\Form;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FormGetRequest $request)
    {
        $forms = FormHelper::getForms($request);

        $additionalData = [
            "pagination:total_items" => $forms->total(),
            "pagination:per_page" => (int)$request->perPage,
            "pagination:page" => (int)$request->page
        ];

        return response()->success(new FormCollection($forms), $additionalData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormPostRequest $request)
    {
        if (!Auth::check()) {
            return response()->error("Must be authenticated", null, 401);
        }

        $newForm = FormHelper::createForm($request);

        return response()->success(new SolicitudeResource($newForm));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        return response()->success(new FormResource($form));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Form $form
     * @param FormPutRequest $request
     * @return Response
     */
    public function update(Form $form, FormPutRequest $request)
    {
        $form = FormHelper::updateForm($form, $request);

        return response()->success(new FormResource($form));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        $form->delete();

        return response()->success(new FormResource($form));
    }

    public static function getFormsToSelect() {
        $forms = Form::all();

        $formattedForms = [];

        foreach ($forms as $form) {
            $formattedForms[] = [
                'id' => $form->id,
                'text' => $form->scholar_level . ' - ' . $form->scholar_course
            ];
        }

        return $formattedForms;
    }
}
