<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{


    /**
     * Get all posts
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $posts = Post::sort($request->input('sort'), $request->input('direction'))
            ->includeRelation(explode(',', $request->input('with')))
            ->filter($request->input())
            ->paginate((int)$request->input('limit') ?? Post::DEFAULT_LIMIT);
        return response()->json([
            'result' => $posts->toArray()['data'],
            'count' => $posts->total()
        ],
            Response::HTTP_OK
        );
    }

    /**
     * Delete post by id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return response()->json([
                'result' => true
            ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
