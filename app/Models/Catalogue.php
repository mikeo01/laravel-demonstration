<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Catalogue extends Model
{
    use HasFactory;

    /**
     * Read connection
     *
     * @var string
     */
    protected $connection = 'read';

    /**
     * Eager loads
     *
     * @var array
     */
    public $with = ['products'];

    /**
     * Relationship to products
     *
     * @return Relation
     */
    public function products(): Relation
    {
        return $this->hasMany(Product::class);
    }
}
