<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{

    /*
     *
     * */
    public function show(Request $request): JsonResponse
    {
        $posts = Post::sort($request->input('sort'), $request->input('direction'))
            ->filter($request->input())
            ->paginate($request->input('limit') ?? Post::DEFAULT_LIMIT);
        return response()->json([
            'result' => $posts->toArray()['data'],
            'count' => $posts->total()
        ]);
    }

    /*
     *
     * */
    public function delete(int $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(
            ['Deleted Successfully: deleted_at' => $post->deleted_at],
            Response::HTTP_OK
        );
    }
}
