<?php

namespace App\Http\Controllers\Api\V1\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Http\Resources\VarietyResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Catalog\Application\ListPlans;
use Src\Catalog\Application\ListVarieties;

class CatalogController extends Controller
{
    public function __invoke(
        ListPlans $listPlans,
        ListVarieties $listVarieties,
        Request $request,
    ): JsonResponse {
        $plans = $listPlans();
        $varieties = $listVarieties();

        return response()->json([
            'status' => 'ok',
            'data' => [
                'plans' => PlanResource::collection($plans)->resolve($request),
                'varieties' => VarietyResource::collection($varieties)->resolve($request),
            ],
        ]);
    }
}
