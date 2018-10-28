<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Support\Facades\Storage;
use App\Download;
use App\Jobs\DownloadResourse;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    /**
     * Show main page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show() {
        $downloads = Download::orderBy('id', 'desc')->get()->all();
        return view('index', [
            'downloads' => Download::orderBy('id', 'desc')->get()->all()
        ]);
    }

    /**
     * Show list of downloads
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function downloadList() {
        return view('downloadsList', [
            'downloads' => Download::orderBy('id', 'desc')->get()->all()
        ]);
    }

    /**
     * Returns a file if exists, 404 if there is no such download in DB or file in Storage
     * @param $id
     * @return mixed
     */
    public function get($id) {
        if ($download = Download::find($id)) {
            try {
                return Storage::download($download->local_path, str_replace(['\\', '/'], '', $download->url));
            } catch(\Exception $e) {
                Log::error($e->getMessage());
                abort(404);
            }
        }
        abort(404);
    }

    /**
     * Adds new resource to downloads list
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request) {
        if (trim($request->input('download-me'))) {
            $download = new Download();
            $download->url = $request->input('download-me');
            $download->status = Download::PENDING;
            $download->save();
            DownloadResourse::dispatch($download);
        }
        return view('index', [
            'downloads' => Download::orderBy('id', 'desc')->get()->all()
        ]);
    }
}
