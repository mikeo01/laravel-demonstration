<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 */
class Product extends Model
{
    use HasFactory;

    /**
     * Relationship to products
     *
     * @return Relation
     */
    public function catalogues(): Relation
    {
        return $this->hasMany(Catalogue::class);
    }
}
