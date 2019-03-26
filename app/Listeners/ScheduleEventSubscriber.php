<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\GenerateSchedule;
use App\Jobs\SendScheduleGeneratedNotification;
use App\Events\ScheduleGenerated;

class ScheduleEventSubscriber
{
    /**
    * Handle request to generate a new Schedule
    *
    * @param Type $var var explanation
    */
    public function onScheduleRequested($event)
    {
        dispatch(new GenerateSchedule($event->schedule))->delay(now()->addSeconds(2));
    }

    /**
    * Handle request to generate a new set of timetables
    *
    * @param Type $var var explanation
    */
    public function onScheduleGenerated($event)
    {
        dispatch(new SendScheduleGeneratedNotification($event->newSchedule))->delay(now()->addSeconds(2));
    }

    /**
    * Register listeners for the various Schedule events.
    *
    * @param \Illuminate\Events\Dispatcher $events
    */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\ScheduleRequested',
            'App\Listeners\ScheduleEventSubscriber@onScheduleRequested'
        );

        $events->listen(
            'App\Events\ScheduleGenerated',
            'App\Listeners\ScheduleEventSubscriber@onScheduleGenerated'
        );
    }


    // /**
    //  * Create the event listener.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     //
    // }

    // /**
    //  * Handle the event.
    //  *
    //  * @param  object  $event
    //  * @return void
    //  */
    // public function handle($event)
    // {
    //     //
    // }
}
