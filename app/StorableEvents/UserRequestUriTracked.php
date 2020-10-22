<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class UserRequestUriTracked extends ShouldBeStored
{
    /**
     * Tracked user id
     * 
     * @var int
     */
    public int $userId;

    /**
     * Tracked request uri
     * 
     * @var string
     */
    public string $requestUri;

    public function __construct(int $userId, string $requestUri)
    {
        $this->userId = $userId;
        $this->requestUri = $requestUri;
    }
}
