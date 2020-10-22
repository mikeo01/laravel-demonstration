<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EventSourcing\Snapshots\EloquentSnapshotRepository as SnapshotsEloquentSnapshotRepository;

class EloquentSnapshotRepository extends SnapshotsEloquentSnapshotRepository
{
    /**
     * Connection
     *
     * @var string
     */
    protected $connection = 'write';
}
