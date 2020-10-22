<?php

namespace Database\Seeders;

use App\Models\Catalogue;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create some catalogue listings
        Catalogue::factory()->count(1)
            ->create()
            ->each(function (Catalogue $catalogue) {
                // Generate some products
                $catalogue->products()
                    ->createMany(Product::factory()->count(1)->make()->toArray());
            });
    }
}
