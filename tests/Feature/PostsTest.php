<?php

class PostsTest extends TestCase
{

//    use Refrez
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetPosts()
    {

        $this->get('api/posts?post_id=1&with=comments&limit=20&page=1&topic=Kir&sort=topic&direction=desc');

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

    public function testDeletePosts()
    {

        $this->delete('api/posts/1', [], ['HTTP_AUTHORIZATION' => env('GIG_AUTH_TOKEN')]);

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
}
