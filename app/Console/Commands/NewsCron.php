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
        $response = Http::get('https://newsapi.org/v2/top-headlines?country=us&apiKey=1594b4ffb97e4bf5af73f2ebca31efc2');

        foreach($response['articles'] as $article){

            if (!is_null($article['description'])) {
            DB::table('readings')->insert([
                [
                    "title" => $article['title'],
                    "url" => $article['url'],
                    "abstract" => $article['description'],
                ]
            ]);
                }
        }
        Log::info('Cron Job Ended');
        // DB::table('readings')->insert($response->json());
    }
}
