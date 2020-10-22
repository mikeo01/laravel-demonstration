<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EventSourcing\Snapshots\EloquentSnapshot as SnapshotsEloquentSnapshot;

class EloquentSnapshot extends SnapshotsEloquentSnapshot
{
    /**
     * Connection
     *
     * @var string
     */
    protected $connection = 'write';
}
