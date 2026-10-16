
<?php

use App\Http\Controllers\Api\V1\Catalog\VarietyController;
use Illuminate\Support\Facades\Route;

Route::get('v1/catalog/varieties', [VarietyController::class, '__invoke']);
