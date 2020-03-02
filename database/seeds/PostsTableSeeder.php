<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 60)->create()->each(function ($post){
            $post->tags()->attach(rand(1, 10));
            $post->tags()->attach(rand(11, 20));
            $post->tags()->attach(rand(21, 30));
        });
    }
}
