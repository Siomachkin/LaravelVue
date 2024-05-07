<?php

namespace App\Console\Commands;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use Illuminate\Console\Command;


class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from a XLS file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->title('Starting import');
        Excel::import(new ProductsImport, base_path('products.xls'));
        $this->output->success('Import successful');
    }
}
