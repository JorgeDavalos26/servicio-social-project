<?php

namespace App\Helpers\Base_Enums;

enum ScholarLevel
{
    case ENGINEERING;
    case TECNOLOGO;

    public static function getText(ScholarLevel $scholarLevel): string
    {
        $text = '';
        switch ($scholarLevel) {
            case ScholarLevel::ENGINEERING:
                $text = 'Ingeniería';
                break;
            case ScholarLevel::TECNOLOGO:
                $text = 'Tecnólogo';
                break;
        }

        return $text;
    }
}

