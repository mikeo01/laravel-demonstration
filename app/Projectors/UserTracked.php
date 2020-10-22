<?php

namespace App\Projectors;

use App\Models\Activity;
use App\Models\User;
use App\StorableEvents\UserRequestUriTracked;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class UserTracked extends Projector
{
    /**
     * Wipe table before we replay events
     */
    public function onStartingEventReplay()
    {
        Activity::truncate();
    }

    /**
     * Project into table
     *
     * @param UserRequestUriTracked $event
     * @return void
     */
    public function onUserRequestUriTracked(UserRequestUriTracked $event)
    {
        // Project
        if ($user = User::find($event->userId)) {
            $user->activity()->create([
                'request_uri' => $event->requestUri,
            ]);
        }
    }
}
