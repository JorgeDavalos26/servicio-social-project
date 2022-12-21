<?php

namespace App\Helpers;

use App\Http\Requests\FormGetRequest;
use App\Http\Requests\FormPostRequest;
use App\Http\Requests\FormPutRequest;
use App\Models\Form;

class FormHelper
{
    public static function getForms(FormGetRequest $request) {
        $forms = Form::query();

        if ($request->has('scholar_level')) {
            $forms = $forms->where('scholar_level', $request->scholar_level);
        }

        if ($request->has('scholar_course')) {
            $forms = $forms->where('scholar_course', $request->scholar_course);
        }

        if ($request->has('paginated') && filter_var($request->paginated, FILTER_VALIDATE_BOOLEAN)) {
            if(!$request->has('perPage')) $request->merge(['perPage' => 10]);
        } else {
            $request->merge(['page' => 1]);
            $request->merge(['perPage' => 100000]);
        }

        $forms = $forms->orderBy('id', 'desc')->paginate($request->perPage);

        return $forms;
    }

    public static function createForm(FormPostRequest $request) {
        return Form::create([
            'description' => $request->description,
            'scholar_course' => $request->scholarCourse,
            'scholar_level' => $request->scholarLevel,
            'label' => $request->label
        ]);
    }

    public static function updateForm(Form $form, FormPutRequest $request): Form
    {
        if ($request->has('description')) $form->description = $request->description;
        if ($request->has('scholarCourse')) $form->scholar_course = $request->scholarCourse;
        if ($request->has('scholarLevel')) $form->scholar_level = $request->scholarLevel;
        if ($request->has('label')) $form->label = $request->label;

        $form->save();

        return $form;
    }
}
