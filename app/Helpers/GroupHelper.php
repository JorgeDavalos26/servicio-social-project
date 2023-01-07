<?php

namespace App\Helpers;

use App\Models\Form;
use App\Models\Group;
use App\Models\Setting;
use App\Models\Solicitude;

class GroupHelper
{
    const ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function addSolicitudeToGroup(Solicitude $solicitude): Solicitude
    {
        $form = Form::find($solicitude->form_id);
        $key = "PERIODS." . $form->scholar_level . '_' . $form->scholar_course . ".MAX_STUDENTS_PER_GROUP";

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
            $studentsRegistered = count($group->solicitudes());
            $maxStudents = Setting::findWhere('key', $key)->value;

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
}
