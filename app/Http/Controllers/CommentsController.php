<?php

namespace App\Http\Controllers;

use Adjudicator\Models\Application;
use Adjudicator\Models\Brand;
use App\Helpers\Helper;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentsController extends Controller
{


    /**
     * Get all comments
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $comments = Comment::sort($request->input('sort'), $request->input('direction'))
            ->filter($request->input())
            ->paginate((int)$request->input('limit') ?? Comment::DEFAULT_LIMIT);
        return response()->json([
            'result' => $comments->toArray()['data'],
            'count' => $comments->total()
        ],
            Response::HTTP_OK
        );
    }

    /**
     * Delete comment by id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();
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

    /**
     * Crete new comment
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            Post::findOrFail($request->input('post_id'));
            $comment = Comment::query()->create(
                $request
                    ->merge([
                        'abbreviation' => Helper::generateAbbreviation(explode(' ', $request->input('content')))
                    ])
                    ->only((new Comment())->getFillable())
            );
            return response()->json([
                'result' => $comment->refresh()->toArray()
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
