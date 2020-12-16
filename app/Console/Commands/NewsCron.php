<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use DB;
use Illuminate\Support\Facades\Log;

class NewsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch fresh news from news api';

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
     * @return int
     */
    public function handle()
    {
        Log::info('Cron Job Started');
        echo "\r\n";
        echo "Cron Job Started";
        echo "\r\n";
        echo "Seeding database and test database";
        echo "\r\n";
        $response = Http::get('https://newsapi.org/v2/everything?q=bitcoin&apiKey=1594b4ffb97e4bf5af73f2ebca31efc2');

        foreach($response['articles'] as $article){

            if (!is_null($article['description'])) {
            DB::connection('mysql')->table('readings')->insert([
                [
                    "title" => $article['title'],
                    "url" => $article['url'],
                    "author" => !empty($article['author']) ? $article['author']: 'Unknown author',
                    "abstract" => $article['description'],
                    "image_url" => !empty($article['urlToImage']) ? $article['urlToImage'] : '',
                    "publishedAt" => $article['publishedAt'],
                ]
            ]);

            DB::connection('mysql_2')->table('readings_test')->insert([
                [
                    "title" => $article['title'],
                    "url" => $article['url'],
                    "author" => !empty($article['author']) ? $article['author']: 'Unknown author',
                    "abstract" => $article['description'],
                    "image_url" => !empty($article['urlToImage']) ? $article['urlToImage'] : '',
                    "publishedAt" => $article['publishedAt'],
                ]
            ]);
                }
        }
        Log::info('Cron Job Ended');
        echo "\r\n";
        echo "Cron Job Ended";
        echo "\r\n";
    }
}
