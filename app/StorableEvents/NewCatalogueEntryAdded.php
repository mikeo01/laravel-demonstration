<?php

namespace App\StorableEvents;

use App\Models\Catalogue;
use App\Models\Product;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewCatalogueEntryAdded extends ShouldBeStored
{
    /**
     * Product
     *
     * @var Product
     */
    public $product;

    /**
     * Catalogue
     *
     * @var Catalogue
     */
    public $catalogue;

    public function __construct(Product $product, Catalogue $catalogue)
    {
        $this->product = $product;
        $this->catalogue = $catalogue;
    }
}
