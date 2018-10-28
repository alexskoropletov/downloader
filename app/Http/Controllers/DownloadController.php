<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Download;
use App\Jobs\DownloadResourse;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function show() {
        $downloads = Download::orderBy('id', 'desc')->get()->all();
        return view('index', [
            'downloads' => Download::orderBy('id', 'desc')->get()->all()
        ]);
    }

    public function downloadList() {
        return view('downloadsList', [
            'downloads' => Download::orderBy('id', 'desc')->get()->all()
        ]);
    }

    public function get($id) {
        if ($download = Download::find($id)) {
            return Storage::download($download->local_path, str_replace(['\\', '/'], '', $download->url));
        }
        abort(404);
    }

    public function store(Request $request) {
        $download = new Download();
        $download->url = $request->input('download-me');
        $download->status = Download::PENDING;
        $download->save();
        DownloadResourse::dispatch($download);
        return view('index', [
            'downloads' => Download::orderBy('id', 'desc')->get()->all()
        ]);
    }

    public function download() {

    }
}
