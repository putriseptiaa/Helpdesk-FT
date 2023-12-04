<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Response;

class DownloadController extends Controller
{
    public function download(){
            $myFile = storage_path('/app/public/surat/suratpernyataan.png'); 
            return response()->download($myFile);
    }
}
