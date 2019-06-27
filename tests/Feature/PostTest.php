<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function usersCanReadPosts()
//    {
//        //Given we have task in the database
//        $post = factory(Post::class)->create();
//        //When user visit the tasks page
//        $response = $this->get('/', array(), array('HTTP_CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'));
//        //He should be able to read the task
//        $response->assertSee($post->title);
//    }
//
//    public function testOyAuthenticatedUserCanCratePost()
//    {
//        //Given we have an authenticated user
//        $this->actingAs(factory(User::class)->create());
//        //And a post object
//        $post = factory(Post::class)->make();
//        //When user submits post request to create post endpoint
//        $this->post('/posts/create', $post->toArray());
//        //It gets stored in the database
//        $this->assertEquals(1,Post::all()->count());
//    }


}
