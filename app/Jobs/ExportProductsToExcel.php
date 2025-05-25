<?php

namespace App\Jobs;

use App\Exports\ProductsExport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportProductsToExcel implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected string $filename;
    /**
     * Create a new job instance.
     */
    public function __construct(string $filename = 'products_export.xlsx')
    {
        $this->filename = $filename;
    }

    public function handle(): void
    {
        Excel::store(new ProductsExport, $this->filename, 'public');
    }
}
