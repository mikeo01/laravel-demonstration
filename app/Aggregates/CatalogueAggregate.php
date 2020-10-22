<?php

namespace App\Aggregates;

use App\Models\Catalogue;
use App\Models\Product;
use App\StorableEvents\NewCatalogueEntryAdded;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

final class CatalogueAggregate extends AggregateRoot
{
    /**
     * Create catalogue entry
     *
     * @param Product $product
     * @param Catalogue $catalogueId
     * @return void
     */
    public function createCatalogueEntry(Product $product, Catalogue $catalogue)
    {
        return $this->recordThat(
            new NewCatalogueEntryAdded($product, $catalogue)
        );
    }
}
