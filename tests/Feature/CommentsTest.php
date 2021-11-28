<?php

use \Illuminate\Http\Response;
use \App\Models\Comment;
use \Laravel\Lumen\Testing\DatabaseTransactions;

class CommentsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *
     */
    public function testCreateComments()
    {
        //create new comment
        $response = $this->post('/api/comments', ['post_id' => '3', 'content' => 'You Can Do It !'], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $comment = Comment::query()->select('comment_id')->orderBy('comment_id', 'desc')->first();
        $this->assertResponseStatus(Response::HTTP_CREATED);
        $jsonResponse = sprintf('
        {
            "result": {
                "comment_id": %s,
                "post_id": 3,
                "content": "You Can Do It !",
                "abbreviation": "ycdi!"
            }
        }
        ', $comment->comment_id ?? 0);

        $response->seeJsonEquals(json_decode($jsonResponse, true));

        //create new comment with same content
        $response = $this->post('/api/comments', ['post_id' => '3', 'content' => 'You Can Do It !'], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->assertResponseStatus(Response::HTTP_INTERNAL_SERVER_ERROR);

        //create new comment with invalid post_id
        $this->post('/api/comments', ['post_id' => '7', 'content' => 'Data Type Abstract Dear Drum'], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        //create new comment with deleted post
        $this->delete('/api/posts/3', [], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->post('/api/comments', ['post_id' => '3', 'content' => 'Data Type Abstract Dear Drum'], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        //crete new comment without Authorization
        $this->post('/api/comments', ['post_id' => '5', 'content' => 'Data Type Abstract Dear Drum']);
        $this->assertResponseStatus(Response::HTTP_UNAUTHORIZED);

        //crete new comment with wrong credentials
        $this->post('/api/comments', ['post_id' => '5', 'content' => 'Data Type Abstract Dear Drum'], ['HTTP_AUTHORIZATION' => 'someRandomString']);
        $this->assertResponseStatus(Response::HTTP_FORBIDDEN);

        //create new comment without post_id
        $this->post('/api/comments', ['content' => 'Data Type Abstract Dear Drum'], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    /**
     *
     */
    public function testGetComments()
    {
        $this->get('/api/comments?post_id=1&limit=20&page=1&content=nice&abbreviation=na&sort=abbreviation&direction=desc');
        $this->assertResponseOk();
    }

    /**
     *
     */
    public function testDeleteComments()
    {
        //delete comment
        $this->delete('/api/comments/260', [], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->assertResponseOk();

        //delete already deleted comment
        $this->delete('/api/comments/260', [], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->assertResponseStatus(Response::HTTP_NOT_FOUND);

        //delete comment without Authorization
        $this->delete('/api/comments/260');
        $this->assertResponseStatus(Response::HTTP_UNAUTHORIZED);

        //delete comment with wrong credentials
        $this->delete('/api/comments/260', [], ['HTTP_AUTHORIZATION' => 'someRandomString']);
        $this->assertResponseStatus(Response::HTTP_FORBIDDEN);

        //delete without comment_id
        $this->delete('api/comments', [], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);
        $this->assertResponseStatus(Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
