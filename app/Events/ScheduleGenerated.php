<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ScheduleGenerated
{
    use Dispatchable, SerializesModels;

    public $newSchedule;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($newSchedule)
    {
        $this->newSchedule = $newSchedule;
    }
}
