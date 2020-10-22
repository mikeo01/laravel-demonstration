<?php

namespace App\Listeners;

use App\Aggregates\UserActivity as AggregatesUserActivity;
use App\Aggregates\UserActivityAggregate;
use App\Events\UserActivity as EventsUserActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Ramsey\Uuid\Uuid;

class UserActivity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventsUserActivity $event)
    {
        UserActivityAggregate::retrieve(Uuid::uuid4()->toString())
            ->track($event->request->user()->id, $event->request->getRequestUri())
            ->persist();
    }
}
