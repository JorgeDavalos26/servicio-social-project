<?php

namespace App\Helpers;

use App\Models\Form;
use App\Models\Group;
use App\Models\Period;
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

        $solicitudes = Solicitude::where('period_id', $period->id)->orderBy('id')->get();

        if ($solicitudes->isEmpty()) return;

        $firstSolicitude = $solicitudes[0];

        $form = Form::find($firstSolicitude->form_id);
        $key = "PERIODS." . $form->scholar_level . '_' . $form->scholar_course . ".MAX_STUDENTS_PER_GROUP";
        $maxStudents = Setting::findWhere('key', $key)->value;

        for ($i = 0; $i < $solicitudes->count(); $i += $maxStudents) {
            $group = Group::create([
                'period_id' => $period->id,
                'name' => $form->scholar_level . '_' . $form->scholar_course .
                    substr(self::ALPHABET, $i % strlen(self::ALPHABET), 1)
            ]);
            $solicitudesToCurrentGroup = array_slice($solicitudes, $maxStudents * $i, $maxStudents);

            foreach ($solicitudesToCurrentGroup as $solicitudeCurrentGroup) {
                $solicitudeCurrentGroup->group_id = $group->id;
                $solicitudeCurrentGroup->save();
            }
        }
    }

    public static function getGroups($input)
    {
        $groups = Group::with(['solicitudes.user']);

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
}
