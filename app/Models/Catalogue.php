<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Catalogue extends Model
{
    use HasFactory;

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
