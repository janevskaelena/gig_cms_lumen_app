<?php

use \Illuminate\Http\Response;

class CommentsTest extends TestCase
{

//    use Refrez
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetComments()
    {

        $this->get('/api/comments?post_id=1&limit=20&page=1&content=nice&abbreviation=na&sort=abbreviation&direction=desc');

//        $this->assertJsonStringEqualsJsonString(
//            '{"result":[{"comment_id":8195,"post_id":1,"content":"ddddddd","abbreviation":"dd"},{"comment_id":8192,"post_id":1,"content":"ddddddd","abbreviation":"d"}],"count":2}',
//        //    json_encode()
//
//        );
//        $this->response->assertExactJson((array)json_decode('{"result":[{"comment_id":8195,"post_id":1,"content":"ddddddd","abbreviation":"dd"},{"comment_id":8192,"post_id":1,"content":"ddddddd","abbreviation":"d"}],"count":2}'));

//        $resp = $this->response->getContent();

//        $this->response->getStatusCode();
        $this->assertResponseOk();

//        dd($resp);
//        $this->assertEquals(
//            $this->app->version(), $this->response->getContent()
//        );
    }

    public function testDeleteComments()
    {

        $this->delete('/api/comments/250', [], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);

//        $this->assertJsonStringEqualsJsonString(
//            '{"result":[{"comment_id":8195,"post_id":1,"content":"ddddddd","abbreviation":"dd"},{"comment_id":8192,"post_id":1,"content":"ddddddd","abbreviation":"d"}],"count":2}',
//        //    json_encode()
//
//        );
//        $this->response->assertExactJson((array)json_decode('{"result":[{"comment_id":8195,"post_id":1,"content":"ddddddd","abbreviation":"dd"},{"comment_id":8192,"post_id":1,"content":"ddddddd","abbreviation":"d"}],"count":2}'));

//        $resp = $this->response->getContent();

//        $this->response->getStatusCode();
        $this->assertResponseOk();

//        dd($resp);
//        $this->assertEquals(
//            $this->app->version(), $this->response->getContent()
//        );
    }

    public function testCreateComments()
    {

        $this->post('/api/comments', ['post_id' => '5', 'content' => 'Data Type Abstract Dear Fast'], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);

//        $this->assertJsonStringEqualsJsonString(
//            '{"result":[{"comment_id":8195,"post_id":1,"content":"ddddddd","abbreviation":"dd"},{"comment_id":8192,"post_id":1,"content":"ddddddd","abbreviation":"d"}],"count":2}',
//        //    json_encode()
//
//        );
//        $this->response->assertExactJson((array)json_decode('{"result":[{"comment_id":8195,"post_id":1,"content":"ddddddd","abbreviation":"dd"},{"comment_id":8192,"post_id":1,"content":"ddddddd","abbreviation":"d"}],"count":2}'));

//        $resp = $this->response->getContent();

//        $this->response->getStatusCode();
        $this->assertResponseStatus(Response::HTTP_CREATED);

//        dd($resp);
//        $this->assertEquals(
//            $this->app->version(), $this->response->getContent()
//        );
    }
}
