<?php

use App\Http\Controllers\SanctumController;
use Illuminate\Support\Facades\Route;

Route::group(
    ["middleware" => []],
    function () {
        Route::POST("/sanctum/token", [SanctumController::class, "issueToken"]);
    }
);
