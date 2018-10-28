<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\DownloadResourse;
use App\Download;

class AddDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:add {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add download resource to the queue';

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
     * @return mixed
     */
    public function handle()
    {
        $download = new Download();
        $download->url = $this->argument('url');
        $download->status = Download::PENDING;
        $download->save();
        DownloadResourse::dispatch($download);
    }
}
