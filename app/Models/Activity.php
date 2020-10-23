<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /**
     * Read connection
     *
     * @var string
     */
    protected $connection = 'read';

    /**
     * Mass fillable
     *
     * @var array
     */
    public $fillable = ['request_uri'];
}
