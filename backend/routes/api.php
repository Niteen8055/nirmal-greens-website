
<?php

use App\Http\Controllers\Api\V1\Catalog\CatalogController;
use App\Http\Controllers\Api\V1\Catalog\PlanController;
use App\Http\Controllers\Api\V1\Catalog\VarietyController;
use Illuminate\Support\Facades\Route;

Route::get('v1/catalog', [CatalogController::class, '__invoke']);
Route::get('v1/catalog/plans', [PlanController::class, '__invoke']);
Route::get('v1/catalog/varieties', [VarietyController::class, '__invoke']);
