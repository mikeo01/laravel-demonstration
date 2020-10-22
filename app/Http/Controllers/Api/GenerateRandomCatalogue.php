<?php

namespace App\Http\Controllers\Api;

use App\Events\GenerateRandomCatalogueEntry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerateRandomCatalogue extends Controller
{
    /**
     * Generate random
     *
     * @return void
     */
    public function generate()
    {
        event(new GenerateRandomCatalogueEntry);

        return response()->json();
    }
}
