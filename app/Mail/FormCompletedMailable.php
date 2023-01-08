<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormCompletedMailable extends Mailable
{
    use Queueable, SerializesModels;

    private $fromEmail;
    private $fromName;

    public $level;
    public $course;

    private Attachment $regulationAttachment;
    private Attachment $paymentSlipAttachment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $fromEmail, string $fromName, string $level, string $course, 
        Attachment $regulationAttachment, Attachment $paymentSlipAttachment)
    {
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
        $this->level = $level;
        $this->course = $course;

        $this->regulationAttachment = $regulationAttachment;
        $this->paymentSlipAttachment = $paymentSlipAttachment;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->fromEmail, $this->fromName),
            subject: 'Formulario completado ' . $this->course . "-" . $this->level,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.form-completed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        $attachs = [];

        if ($this->regulationAttachment) $attachs[] = $this->regulationAttachment;
        if ($this->paymentSlipAttachment) $attachs[] = $this->paymentSlipAttachment;

        return $attachs;
    }
}
