<?php

namespace App\Helpers;

use App\Exceptions\EmailAttachmentCustomException;
use App\Mail\FormCompletedMailable;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailHelper {

    public static function sendFormCompletedMail($input) {
        $from = Setting::where("key", "FORMS.COMPLETED_FORM.FROM_EMAIL_ADDRESS")->first();
        $user = User::find($from->value);

        $fromMail = $user->email;
        $fromName = $user->username;
        $level = $input["level"];
        $course = $input["course"];
        $to = $input["to"] ?? user()->getEmail();

        if (!Storage::disk('local_custom')->exists('/assets/reglamento.pdf')) {
            throw new EmailAttachmentCustomException(__('The file :file has not been found', ['file' => 'reglamento.pdf']));
        }
        else if (!Storage::disk('local_custom')->exists('/assets/fichadepago.pdf')) {
            throw new EmailAttachmentCustomException(__('The file :file has not been found', ['file' => 'fichadepago.pdf']));
        }

        $regulationAttachment = Attachment::fromStorageDisk('local_custom', '/assets/reglamento.pdf')
            ->as('el_reglamento.pdf')
            ->withMime('application/pdf');
        $paymentSlipAttachment = Attachment::fromStorageDisk('local_custom', '/assets/fichadepago.pdf')
            ->as('la_fichadepago.pdf')
            ->withMime('application/pdf');

        Mail::to($to)->send(
            new FormCompletedMailable($fromMail, $fromName, $level, $course, $regulationAttachment, $paymentSlipAttachment));
    }

}