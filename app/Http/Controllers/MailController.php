<?php

namespace App\Http\Controllers;

use App\Mail\FormCompletedMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    
    public function sendMailTest() {
        
        $yeah = 5;
        
        Mail::to("jorge6alberto@gmail.com")->send(new FormCompletedMailable());
    }

}
