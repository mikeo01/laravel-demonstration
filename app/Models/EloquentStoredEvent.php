<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent as ModelsEloquentStoredEvent;

class EloquentStoredEvent extends ModelsEloquentStoredEvent
{
    /**
     * Connection
     *
     * @var string
     */
    protected $connection = 'write';
}
