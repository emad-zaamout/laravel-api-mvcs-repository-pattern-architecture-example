<?php

use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

Route::group(
    ["middleware" => ["auth:sanctum"]],
    function () {
        Route::POST("/students", [StudentsController::class, "update"]);
        Route::GET("/students/{id}", [StudentsController::class, "get"]);
        Route::DELETE("/students/{id}", [StudentsController::class, "softDelete"]);
    }
);
