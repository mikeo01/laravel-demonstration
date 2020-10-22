<?php

namespace App\Aggregates;

use App\StorableEvents\UserRequestUriTracked;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

final class UserActivityAggregate extends AggregateRoot
{
    /**
     * Tracked event
     *
     * @param int $userId
     * @param string $requestUri
     * @return void
     */
    public function track(int $userId, string $requestUri): self
    {
        return $this->recordThat(
            new UserRequestUriTracked($userId, $requestUri)
        );
    }
}
