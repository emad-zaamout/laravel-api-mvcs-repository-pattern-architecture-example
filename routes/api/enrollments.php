<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudentsCoursesEnrollmentsController;
use Illuminate\Support\Facades\Route;

Route::group(
    ["middleware" => ["auth:sanctum"]],
    function () {
        Route::POST("/enrollments", [StudentsCoursesEnrollmentsController::class, "update"]);
        Route::GET("/enrollments/{id}", [StudentsCoursesEnrollmentsController::class, "get"]);
        Route::DELETE("/enrollments/{id}", [StudentsCoursesEnrollmentsController::class, "softDelete"]);
    }
);
