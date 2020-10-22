<?php

namespace App\Listeners;

use App\Aggregates\CatalogueAggregate;
use App\Events\GenerateRandomCatalogueEntry as EventsGenerateRandomCatalogueEntry;
use App\Models\Catalogue;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Ramsey\Uuid\Uuid;

class GenerateRandomCatalogueEntry
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @todo not really done properly, just for demonstration purposes
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventsGenerateRandomCatalogueEntry $event)
    {
        $product = new Product([
            'name' => now() . ' this is a test',
            'price' => 100.00
        ]);

        CatalogueAggregate::retrieve(Uuid::uuid4()->toString())
            ->createCatalogueEntry($product, Catalogue::limit(1)->first())
            ->persist();
    }
}
