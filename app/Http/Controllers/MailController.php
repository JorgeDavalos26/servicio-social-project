<?php

namespace App\Http\Controllers;

use App\Helpers\MailHelper as HelpersMailHelper;
use App\Http\Requests\MailFormCompletedRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use MailHelper;

class MailController extends Controller
{

    public function sendFormCompletedMail(MailFormCompletedRequest $request) {
        $input = $request->validated();
        Gate::authorize('sendFormCompletedMail');
        $from = Setting::where("key", "FORMS.COMPLETED_FORM.FROM_EMAIL_ADDRESS")->first();
        HelpersMailHelper::sendFormCompletedMail($from->value, $input['to']);
        return response()->success(__('Email sent successfully'));
    }

}
