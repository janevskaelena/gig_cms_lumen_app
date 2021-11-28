<?php

namespace Database\Seeders;

use App\Helpers\Helper;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Predefined variable for seeding the database
     * @var string
     */
    private $randomWords = 'Cool,Strange,Funny,Laughing,Nice,Awesome,Great,Horrible,Beautiful,PHP,Vegeta,Italy,Joost';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //make an array
        $arRandomWords = explode(',', strtolower($this->randomWords));
        //get all the combinations
        $arContent = Helper::generateAllCombinations($arRandomWords);
        //get the post ids
        $posts = collect(Post::all()->modelKeys());
        $arData = [];
        foreach ($arContent as $content) {
            array_push($arData, [
                'post_id' => $posts->random(),
                'content' => implode(' ', $content),
                'abbreviation' => Helper::generateAbbreviation($content)
            ]);
        }
        //Insert the data in one go
        Comment::insert($arData);

//        Comment::factory()->createMany($arData);
    }
}
