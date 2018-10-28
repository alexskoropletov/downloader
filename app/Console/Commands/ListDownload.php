<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Download;

class ListDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all the downloads';

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
        $headers = ['URL', 'Status', 'Download link'];
        $download = array_map(
            function($item) {
                return [
                    'url' => $item->url,
                    'status' => $item->getStatusName(),
                    'link' => $item->isReady() ? $item->local_path : ''
                ];
            },
            Download::orderBy('id', 'desc')->get()->all()
        );

        $this->table($headers, $download);
    }
}
