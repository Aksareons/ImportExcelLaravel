<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelsImport;
use App\Models\Item;

class ExcelController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            $count = Item::all()->count();
            $fileSize = $file->getSize();
                if ($fileSize == false) return back()->withStatus('что-то не так!!!   сликом большой файл ');
            
            $this->validate($request, [
                'file' =>'file|required|mimes:xls,xlsx|max:2048'
            ]);
        
         
           (new ExcelsImport)->import($file);
           $result = Item::all()->count() - $count;
           $time_end = microtime(true);
    $time = round($time_end - LARAVEL_START, 2);
    return back()->withStatus(".$result успешных импортов, за : .$time сек...");
           
        }   
        return back()->withStatus('что-то не так!!! Выберете файл        ');
    }
}
