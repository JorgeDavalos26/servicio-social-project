<?php

namespace App\Helpers;

use App\Enums\SolicitudeStatus;
use App\Models\Answer;
use App\Models\Field;
use App\Models\Form;
use App\Models\Group;
use App\Models\Period;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Solicitude;

class GroupHelper
{
    const ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function addSolicitudeToGroup(Solicitude $solicitude): Solicitude
    {
        $form = Form::find($solicitude->form_id);

        $groupsOfPeriod = Group::where('period_id', $solicitude->period_id)
            ->orderBy('id', 'DESC')
            ->get();

        if ($groupsOfPeriod->isEmpty()) {
            $group = Group::create([
                'period_id' => $solicitude->period_id,
                'name' => $form->scholar_level . '_' . $form->scholar_course . '_A'
            ]);
        } else {
            $group = $groupsOfPeriod[0];
            $key = "PERIODS." . $form->scholar_level . '_' . $form->scholar_course . ".MAX_STUDENTS_PER_GROUP";
            $maxStudents = Setting::firstWhere('key', $key)->value;
            $studentsRegistered = Solicitude::where('group_id', $group->id)->count();

            if ($studentsRegistered >= $maxStudents) {
                $group = Group::create([
                    'period_id' => $solicitude->period_id,
                    'name' => $form->scholar_level . '_' . $form->scholar_course .
                        substr(self::ALPHABET, (count($groupsOfPeriod) + 1) % strlen(self::ALPHABET), 1)
                ]);
            }
        }

        $solicitude->group_id = $group->id;

        $solicitude->save();

        return $solicitude;
    }

    public static function regenerateAllGroupsOfPeriod(Period $period): void
    {
        Group::where('period_id', $period->id)->delete();

        $solicitude = Solicitude::where('period_id', $period->id)->orderBy('id')->first();
        if ($solicitude == null) return;
        $firstSolicitude = $solicitude;

        $form = Form::find($firstSolicitude->form_id);
        $key = "PERIODS." . $form->scholar_level . '_' . $form->scholar_course . ".MAX_STUDENTS_PER_GROUP";
        $maxStudents = Setting::findWhere('key', $key)->value;

        $groupNumber = 0;

        while (Solicitude::where('period_id', $period->id)
            ->where('group_id', null)
            ->exists()) {
            $group = Group::create([
                'period_id' => $period->id,
                'name' => $form->scholar_level . '_' . $form->scholar_course .
                    substr(self::ALPHABET, $groupNumber % strlen(self::ALPHABET), 1)
            ]);

            Solicitude::where('period_id', $period->id)
                ->where('group_id', null)
                ->orderBy('id')
                ->limit($maxStudents)
                ->update(['group_id' => $group->id]);
        }
    }

    public static function getGroups($input): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $groups = Group::query();

        if (isset($input['periodId'])) {
            $groups = $groups->where('period_id', $input['periodId']);
        }

        if (isset($input['paginated']) && to_boolean($input['paginated'])) {
            if (!isset($input['perPage'])) $input['perPage'] = 10;
            if (!isset($input['page'])) $input['page'] = 1;
        } else {
            $input['perPage'] = 10;
            $input['page'] = 1;
        }

        return $groups->orderBy('id', 'desc')
            ->paginate(perPage: $input['perPage'], page: $input['page']);
    }

    public static function parseGroupsForTableDisplay(array $groups): array
    {
        $toReturn = [];

        foreach ($groups as $group) {
            $innerToReturn = [
                "id" => $group->id,
                "periodId" => $group->period_id,
                "name" => $group->name
            ];

            $solicitudes = Solicitude::with(['user'])->where('group_id', $group->id)->get();

            if ($solicitudes->isEmpty()) {
                $toReturn[] = $innerToReturn + array("solicitudes" => []);
                continue;
            } else {
                $innerToReturn = $innerToReturn + array("solicitudes" => []);
            }

            $nameFieldId = Field::where('backend_name', 'nombre')->first()->id;
            $firstLastNameFieldId = Field::where('backend_name', 'paterno')->first()->id;
            $secondLastNameFieldId = Field::where('backend_name', 'materno')->first()->id;

            $nameQuestionId = Question::where('form_id', $solicitudes[0]->form_id)
                ->where('field_id', $nameFieldId)
                ->first()
                ->id;
            $firstLastNameQuestionId = Question::where('form_id', $solicitudes[0]->form_id)
                ->where('field_id', $firstLastNameFieldId)
                ->first()
                ->id;
            $secondLastNameQuestionId = Question::where('form_id', $solicitudes[0]->form_id)
                ->where('field_id', $secondLastNameFieldId)
                ->first()
                ->id;

            foreach ($solicitudes as $solicitude) {
                $nameValue = Answer::where('question_id', $nameQuestionId)
                    ->where('solicitude_id', $solicitude->id)
                    ->first()
                    ->value;
                $firstLastNameValue = Answer::where('question_id', $firstLastNameQuestionId)
                    ->where('solicitude_id', $solicitude->id)
                    ->first()
                    ->value;
                $secondLastNameValue = Answer::where('question_id', $secondLastNameQuestionId)
                    ->where('solicitude_id', $solicitude->id)
                    ->first()
                    ->value;

                $innerToReturn['solicitudes'][] = [
                    "id" => $solicitude->id,
                    "name" => $nameValue,
                    "firstLastName" => $firstLastNameValue,
                    "secondLastName" => $secondLastNameValue,
                    "payed" => $solicitude->staus == SolicitudeStatus::PAYMENT_REGISTERED->value,
                ];
            }

            $toReturn[] = $innerToReturn;
        }

        return $toReturn;
    }
}
