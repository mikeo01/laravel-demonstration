<?php

namespace App\Projectors;

use App\StorableEvents\NewCatalogueEntryAdded;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CatalogueEntryProjector extends Projector
{
    /**
     * Project new catalogue product
     *
     * @param NewCatalogueEntryAdded $event
     * @return void
     */
    public function onNewCatalogueEntryAdded(NewCatalogueEntryAdded $event)
    {
        $event->catalogue
            ->products()
            ->save($event->product);
    }
}
