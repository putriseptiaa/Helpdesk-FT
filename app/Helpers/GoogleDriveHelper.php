<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class GoogleDriveHelper
{
    public static function upload($dirSave = null, $id, $lastName, $file)
    {
        // dd($file->extension());
        Storage::disk('google')->put($dirSave . '/' . $id . ' ' . $lastName . '.' . $file->extension(), $file->getContent());
    }

    public static function download($dir = '/', $fileName)
    {
        // dd($fileName);
        // $filename = 'test2.txt';
        $recursive = true; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));
        // dd($contents[1]->extraMetadata()['filename']);
        // dd(pathinfo($filename, PATHINFO_FILENAME));

        $file = $contents
            ->where('type', '=', 'file')
            ->where('extraMetadata.filename', '=', pathinfo($fileName, PATHINFO_FILENAME))
            ->where('extraMetadata.extension', '=', pathinfo($fileName, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!

        if (!$file) {
            return back();
        }
        // dd($file);
        //return $file; // array with file info

        $rawData = Storage::disk('google')->get($file['path']);
        // dd($rawData);
        return response($rawData, 200)
            ->header('ContentType', $file->mimetype())
            ->header('Content-Disposition', "attachment; filename=$fileName");
    }
}
