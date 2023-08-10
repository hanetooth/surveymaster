<?php

namespace App\Listeners;

use App\Events\FormSubmitted;
use App\Mail\FormSubmitNotificationMail;
use App\Models\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class FormSubmittedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(Submission $submittedForm )
    {
        $this->submittedForm = $submittedForm;
    }

    /**
     * Handle the event.
     */
    public function handle(FormSubmitted $event): void
    {
        $submittedForm = $event->submittedForm;
        \Log::info('FormSubmittedNotification', ['submittedForm' => $submittedForm]);
        Mail::to($submittedForm['form']['owner']['email'])->send(
            new FormSubmitNotificationMail($submittedForm)
        );
    }
}
