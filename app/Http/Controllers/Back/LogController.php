<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogController extends Controller
{
    public function index()
    {
        $directories = Storage::disk('logs')->directories('guardian/');

        return view('back.logs.index',compact('directories'));
    }

    public function logFiles(Request $request)
    {
        $directory = $request->directory;
        if( !Storage::disk('logs')->exists($directory)){
            return response()->json('Not found',404);
        }

        $files = Storage::disk('logs')->allFiles($directory);

        return response()->json($files,200);
    }

    public function getFileContent(Request $request)
    {
        $file = $request->path;

        if(!Storage::disk('logs')->exists($file)){
            return response()->json('Not found',404);
        }

        return Storage::disk('logs')->get($file);
    }

    public function downloadLogs(Request $request)
    {
        $path = $request->path;
        if(!Storage::disk('logs')->exists($path)){
            return response()->json('Not found',404);
        }

        $zip = new \ZipArchive();
        $zip->open('LogFiles.zip',\ZipArchive::CREATE);
        $files = Storage::disk('logs')->allFiles($path);

        foreach ($files as $file){
            $zip->addFile(storage_path().'/app/logs/'.$file,'files/'.basename($file));
        }
        $zip->addFromString('Readme.txt','These files contain sensitive information.
            If you are not the authorized personnel, please kindly delete this');
        $zip->close();
        return response()->download(public_path('LogFiles.zip'),'LogFiles.zip',['Content-Disposition'=>'attachment','Content-Type'=>'application/zip'])
            ->deleteFileAfterSend(true);
    }
}