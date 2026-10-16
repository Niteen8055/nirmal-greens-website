<?php

namespace App\Http\Controllers\Api\V1\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Catalog\Application\ListPlans;

class PlanController extends Controller
{
    public function __invoke(ListPlans $handler, Request $request): JsonResponse
    {
        $plans = $handler();

        return response()->json([
            'status' => 'ok',
            'data' => PlanResource::collection($plans)->resolve($request),
        ]);
    }
}
