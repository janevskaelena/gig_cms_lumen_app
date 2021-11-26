<?php

namespace App\Http\Controllers;

use Adjudicator\Models\Application;
use Adjudicator\Models\Brand;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentsController extends Controller
{

    /*
     *
     * */
    public function show(Request $request): JsonResponse
    {
        $comments = Comment::sort($request->input('sort'), $request->input('direction'))
            ->filter($request->input())
            ->paginate((int)$request->input('limit') ?? Comment::DEFAULT_LIMIT);
        return response()->json([
            'result' => $comments->toArray()['data'],
            'count' => $comments->total()
        ]);
    }

    /*
     *
     * */
    public function delete(int $id): JsonResponse
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();
            return response()->json(
                ['Deleted Successfully: deleted_at' => $comment->deleted_at],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $comment = Comment::query()->create(
                $request->only((new Comment())->getFillable())
            );
            return response()->json([
                'result' => $comment->refresh()->toArray(),
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
