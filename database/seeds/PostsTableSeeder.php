<?php

use Quill\Post;
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
        Post::truncate();

        $posts = factory(Post::class, 30)->make();

        foreach ($posts as $post) {
            $post->save();

            factory(Post::class, 5)->create([
                'parent_id' => $post->id,
                'title' => null,
                'slug' => null
            ]);
        }
    }
}
