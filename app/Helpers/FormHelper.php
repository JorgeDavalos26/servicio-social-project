<?php

namespace App\Helpers;

use App\Http\Requests\FormGetRequest;
use App\Http\Requests\FormPostRequest;
use App\Http\Requests\FormPutRequest;
use App\Models\Form;

class FormHelper
{
    public static function getForms($getRequest)
    {
        $forms = Form::query();

        if (isset($getRequest['scholar_level'])) {
            $forms = $forms->where('scholar_level', $getRequest['scholar_level']);
        }

        if (isset($getRequest['scholar_course'])) {
            $forms = $forms->where('scholar_course', $getRequest['scholar_course']);
        }

        if (isset($getRequest['paginated']) && to_boolean($getRequest['paginated'])) {
            if(!isset($getRequest['perPage'])) $getRequest['perPage'] = 10;
            if(!isset($getRequest['page'])) $getRequest['page'] = 1;
        } else {
            $getRequest['perPage'] = 10;
            $getRequest['page'] = 1;
        }

        $forms = $forms->orderBy('id', 'desc')
            ->paginate(perPage: $getRequest['perPage'], page: $getRequest['page']);

        return $forms;
    }

    public static function createForm($input) {
        return Form::create([
            'description' => $input['description'],
            'scholar_course' => $input['scholarCourse'],
            'scholar_level' => $input['scholarLevel'],
            'label' => $input['label']
        ]);
    }

    public static function updateForm(Form $form, $input): Form
    {
        if (isset($input['description'])) $form->description = $input['description'];
        if (isset($input['scholarCourse'])) $form->scholar_course = $input['scholarCourse'];
        if (isset($input['scholarLevel'])) $form->scholar_level = $input['scholarLevel'];
        if (isset($input['label'])) $form->label = $input->label;

        $form->save();

        return $form;
    }
}
