<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\ScheduleGenerated;
use Illuminate\Support\Facades\Mail;

class SendScheduleGeneratedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $newSchedule;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($newSchedule)
    {
        $this->newSchedule = $newSchedule;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('diegolascano@gmail.com')->send(new ScheduleGenerated($this->newSchedule));
    }
}
