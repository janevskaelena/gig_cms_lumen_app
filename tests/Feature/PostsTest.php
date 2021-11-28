<?php

use \Laravel\Lumen\Testing\DatabaseTransactions;
use \Illuminate\Http\Response;

class PostsTest extends TestCase
{
    use DatabaseTransactions;


    /**
     *
     */
    public function testGetPosts()
    {
        $this->get('api/posts?post_id=1&with=comments&limit=20&page=1&topic=Kir&sort=topic&direction=desc');
        $this->assertResponseOk();
    }

    /**
     *
     */
    public function testDeletePosts()
    {
        //delete post
        $this->delete('api/posts/1', [], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->assertResponseOk();

        //delete already deleted post
        $this->delete('api/posts/1', [], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->assertResponseStatus(Response::HTTP_NOT_FOUND);

        //delete without post_id
        $this->delete('api/posts', [], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->assertResponseStatus(Response::HTTP_METHOD_NOT_ALLOWED);

        //delete post without Authorization
        $this->delete('/api/posts/2');
        $this->assertResponseStatus(Response::HTTP_UNAUTHORIZED);

        //delete post with wrong credentials
        $this->delete('/api/posts/2', [], ['HTTP_AUTHORIZATION' => 'someRandomString']);
        $this->assertResponseStatus(Response::HTTP_FORBIDDEN);
    }
}
