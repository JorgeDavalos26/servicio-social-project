<?php

namespace App\Helpers;

use App\Mail\FormCompletedMailable;
use Illuminate\Support\Facades\Mail;

class MailHelper {

    public static function sendFormCompletedMail($fromMail, $toMail) {

        Mail::to($toMail)->send(new FormCompletedMailable($fromMail));

    }

}