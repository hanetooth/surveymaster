<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FormSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $submittedForm;

    /**
     * Create a new event instance.
     * @param array $submittedForm
     */
    public function __construct(array $submittedForm)
    {
        $this->submittedForm = $submittedForm;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
