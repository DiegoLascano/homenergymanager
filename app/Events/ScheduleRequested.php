<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\InteractsWithSockets;

class ScheduleRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $schedule;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new Channel('schedule-requested');
    // }
}
