<?php

namespace App\Http\Controllers;

use App\Exports\CataloguesExport;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    /**
     * Download report
     *
     * @return void
     */
    public function download()
    {
        return Excel::download(new CataloguesExport, 'catalogues.xlsx');
    }
}
