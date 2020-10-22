<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\StoredEvents\Repositories\EloquentStoredEventRepository as RepositoriesEloquentStoredEventRepository;

class EloquentStoredEventRepository extends RepositoriesEloquentStoredEventRepository
{
    /**
     * Connection
     *
     * @var string
     */
    protected $connection = 'write';
}
