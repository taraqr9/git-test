<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LookStoreRequest;
use App\Http\Requests\LookUpdateRequest;
use App\Models\Look;
use Exception;
use Illuminate\Http\JsonResponse;

class LookController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $looks = Look::latest()->paginate(2);

            return response()->json([
                'code' => 200,
                'data' => $looks,
                'message' => 'List of looks',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch looks',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(LookStoreRequest $request): JsonResponse
    {
        try {
            $look = Look::create($request->validated());

            return response()->json([
                'code' => 201,
                'data' => $look,
                'message' => 'Look created',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create look',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $look = Look::find($id);

            if (! $look) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Look not found',
                ], 404);
            }

            return response()->json([
                'code' => 200,
                'data' => $look,
                'message' => 'Look found successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Look not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(LookUpdateRequest $request, $id): JsonResponse
    {
        try {
            $look = Look::find($id);

            if (! $look) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Look not found',
                ], 404);
            }

            $look->update($request->validated());

            return response()->json([
                'code' => 200,
                'data' => $look,
                'message' => 'Look updated',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update look',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $look = Look::find($id);

            if (! $look) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Look not found',
                ], 404);
            }

            $look->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Look marked as deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete look',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
