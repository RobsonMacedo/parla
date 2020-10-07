<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class DownloadFileFromUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parla:download-file-from-url {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download a file from an URL and save into storage folder';

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
        try {
            $url = $this->argument('url');

            if (Str::startsWith($url, '/')) {
                $url = config('app.url') . $url;
            }

            $fileContent = file_get_contents($url);

            $extension = pathinfo(
                parse_url($url, PHP_URL_PATH),
                PATHINFO_EXTENSION
            );

            $hash = sha1($fileContent);

            $photo = \Storage::disk('public')->put(
                $fileName = $hash . '.' . $extension,
                $fileContent
            );

            dump('Downloaded file ' . $fileName . ' from ' . $url);
        } catch (\Exception $exception) {
            dump(
                'Exception ' .
                    basename($exception) .
                    ' - ' .
                    $exception->getMessage()
            );
            report($exception);
        }
    }
}
