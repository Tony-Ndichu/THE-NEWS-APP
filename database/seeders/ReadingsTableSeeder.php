<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Reading;

class ReadingsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('readings')->delete();

        DB::table('readings')->insert([
            [
                "title" =>  "The daily tech fix - gots to have it",
                "url" => "https://techcrunch.com",
                "abstract"=> "Who invested in who? what is the big tech up to?",
                "read_status" => 0
            ],
            [
                "title" => "HN: daily geeek fix",
                "url" => "https://news.ycombinator.com",
                "abstract" => "This one is awesome - for sure",
                "read_status" => 0
            ],
            [
                "title" => "Semi public Danish news - no paywall",
                "url" => "https://tv2.dk",
                "abstract" => "A daily read for most Danish including my dad",
                "read_status" => 0
            ],
            [
                "title" => "Daily Danish business news - paywall",
                "url" => "https://borsen.dk",
                "abstract" => "Note: in danish - maintstram business news",
                "read_status" => 0
            ],
            [
                "title" => "Good old FT",
                "url" => "https://tf.com",
                "abstract" => "how are the return? what to invest in - find it here",
                "read_status" => 0
            ]
        ]);
    }

}