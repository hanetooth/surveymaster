<?php

namespace App\Mail;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormSubmitNotificationMail extends Mailable
{

    /**
     * Create a new message instance.
     * @param array $submittedForm
     */
    public function __construct(array $submittedForm)
    {
        $this->submittedForm = $submittedForm;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->text('mails.form.submitted_notification')
                    ->subject('New answer Submitted')
                    ->with([
                        'form' => $this->submittedForm['form'],
                        'answers' => $this->submittedForm['answers'],
                    ]);
    }
}
