<?php

namespace App\Enums;

enum SolicitudeStatus: String {
    case NEW = "Nuevo";
    case COMPLETED = "Completado";
    case WAITING_PAYMENT = "Esperando Pago";
    case PAYMENT_REGISTERED = "Pago Registrado";
    case REJECTED = "Rechazado";
}
