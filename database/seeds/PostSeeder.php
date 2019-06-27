<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::query()->delete();
        factory(\App\Models\Post::class, 30)->create()->each(function($u) {});
    }
}
