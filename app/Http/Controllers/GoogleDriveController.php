<?php

namespace App\Http\Controllers;

use App\Helpers\GoogleDriveHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoogleDriveController extends Controller
{
    public function download(Request $request)
    {
        if ($request->dir && $request->fileName) {
            return GoogleDriveHelper::download($request->dir, $request->fileName);
        }
        return back();
    }
}
