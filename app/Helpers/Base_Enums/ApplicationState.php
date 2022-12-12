<?php

namespace App\Helpers\Base_Enums;

enum ApplicationState {
    case IN_REVISION;
    case COMPLETED;
    case CANCELED;

    public static function getText(ApplicationState $applicationState): string
    {
        $text = '';
        switch ($applicationState) {
            case ApplicationState::IN_REVISION:
                $text = 'En Revisión';
                break;
            case ApplicationState::COMPLETED:
                $text = 'Completado';
                break;
            case ApplicationState::CANCELED:
                $text = 'Cancelado';
                break;
        }

        return $text;
    }
}
