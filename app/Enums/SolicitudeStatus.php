<?php

namespace App\Enums;

enum SolicitudeStatus: String {
    case NEW = "Nuevo";
    case COMPLETED = "Completado";
    case IN_REVIEW = "Revisando";
    case ACCEPTED = "Aceptado";
    case REJECTED = "Rechazado";
}
