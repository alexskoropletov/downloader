<?php

namespace App\Jobs;

use Log;
use Illuminate\Http\File;
use App\Download;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class DownloadResourse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    protected $download;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Download $download)
    {
        $this->download = $download;
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addSeconds(5);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->download->status = Download::PROCESSING;
        $this->download->save();
        $localPath = sprintf('resources/%d/%s/%s', date('Y'), date('m'), date('d'));
        $localFileName = sprintf('%s/%s.stuff', $localPath, md5($this->download->url . $this->download->id));
        try {
            $contents = file_get_contents($this->download->url);
        } catch (\Exception $e) {
            $this->download->status = Download::ERROR;
            $this->download->save();
            Log::error($e->getMessage());

            return;
        }
        Storage::makeDirectory($localPath);
        Storage::put($localFileName, $contents);
        $this->download->local_path = $localFileName;
        $this->download->status = Download::READY;
        $this->download->save();
    }
}
