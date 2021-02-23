<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Data\Models\ArticlePhoto as ArticlePhotoModel;
use Illuminate\Support\Str;

class DownloadImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parla:download-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download all external images and save to storage folder';

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
        foreach (ArticlePhotoModel::cursor() as $articlePhoto) {
            foreach (['high', 'low'] as $res) {
                try {
                    $url = $articlePhoto->{'url_' . $res . 'res'};

                    if (Str::startsWith($url, '/')) {
                        $url = config('app.url') . $url;
                    }

                    $image = file_get_contents($url);

                    $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);

                    $hash = sha1($image);

                    $photo = \Storage::disk('public')->put(
                        $fileName = $hash . '.' . $extension,
                        $image
                    );

                    dump('Downloaded image ' . $fileName . ' from ' . $url);

                    $articlePhoto->{'url_' . $res . 'res'} = \Storage::disk('public')->url(
                        $fileName
                    );

                    $articlePhoto->save();
                } catch (\Exception $exception) {
                    dump('Exception ' . basename($exception) . ' - ' . $exception->getMessage());
                    report($exception);
                }
            }
        }
        return 0;
    }
}
