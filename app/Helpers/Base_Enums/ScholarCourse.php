<?php

namespace App\Helpers\Base_Enums;

enum ScholarCourse {
    case PROPEDEUTICO;
    case NIVELATION;

    public static function getText(ScholarCourse $scholarCourse): string
    {
        $text = '';
        switch ($scholarCourse) {
            case ScholarCourse::PROPEDEUTICO:
                $text = 'Propedéutico';
                break;
            case ScholarCourse::NIVELATION:
                $text = 'Nivelación';
                break;
        }

        return $text;
    }
}
