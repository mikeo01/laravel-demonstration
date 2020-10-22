<?php

namespace App\Exports;

use App\Models\Catalogue;
use Maatwebsite\Excel\Concerns\FromCollection;

class CataloguesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $excel = Catalogue::all()
            ->mapWithKeys(function (Catalogue $catalogue) {
                return [$catalogue->name => [
                    'stock' => $catalogue->stock,
                    'product_listing' => $catalogue->products()->count()
                ]];
            })
            ->map(function (array $values, string $key) {
                return [$key, $values['stock'], $values['product_listing']];
            });

        return collect([[
            'catalogue_name',
            'stock',
            'number of products in catalogue'
        ]])->concat($excel);
    }
}
