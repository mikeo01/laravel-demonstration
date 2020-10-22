<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class UserRequestUriTracked extends ShouldBeStored
{
    /**
     * Tracked request uri
     * 
     * @var string
     */
    public string $requestUri;

    public function __construct(string $requestUri)
    {
        $this->requestUri = $requestUri;
    }
}
