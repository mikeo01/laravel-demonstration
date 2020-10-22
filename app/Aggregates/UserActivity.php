<?php

namespace App\Aggregates;

use App\StorableEvents\UserRequestUriTracked;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class UserActivity extends AggregateRoot
{
    /**
     * Tracked event
     *
     * @param string $requestUri
     * @return void
     */
    public function track(string $requestUri)
    {
        return $this->recordThat(
            new UserRequestUriTracked($requestUri)
        );
    }
}
