<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelsImport;
use Illuminate\Support\Facades\Storage;


class ImportExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $path = public_path( 'excel/catalog_for_test.xlsx');
        Excel::import(new ExcelsImport, $path, null, \Maatwebsite\Excel\Excel::XLSX);
        // Excel::import(new ExcelsImport, $path);
        return 0;
    }
}
