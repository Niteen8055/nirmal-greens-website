<?php

namespace App\Http\Controllers\Api\V1\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Resources\VarietyResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Catalog\Application\ListVarieties;

class VarietyController extends Controller
{
    public function __invoke(ListVarieties $handler, Request $request): JsonResponse
    {
        $varieties = $handler();

        return response()->json([
            'status' => 'ok',
            'data' => VarietyResource::collection($varieties)->resolve($request),
        ]);
    }
}
