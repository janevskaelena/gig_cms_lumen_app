<?php

namespace Database\Factories;

use App\Helpers\Helper;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     * This is not used for seeding the database
     *
     * @return array
     */
    public function definition()
    {

    }

}
