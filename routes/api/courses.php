<?php

use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;

Route::group(
    ["middleware" => ["auth:sanctum"]],
    function () {
        Route::POST("/courses", [CoursesController::class, "update"]);
        Route::GET("/courses/{id}", [CoursesController::class, "get"]);
        Route::DELETE("/courses/{id}", [CoursesController::class, "softDelete"]);
    }
);
