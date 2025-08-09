<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use Exception;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request): JsonResponse
    {
        try {
            $look = Comment::create($request->validated());

            return response()->json([
                'code' => 201,
                'data' => $look,
                'message' => 'Comment added',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create look',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $comment = Comment::find($id);

            if (! $comment) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Comment not found',
                ], 404);
            }

            $comment->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Comment marked as deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed to delete comment',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
