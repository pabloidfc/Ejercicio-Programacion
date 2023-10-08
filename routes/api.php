<?php

use App\Http\Controllers\TareaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TareaController::class) -> group(function () {
    Route::post("/task", "create");
    Route::get("/task", "list");
    Route::get("/task/title", "listForTitle");
    Route::get("/task/author", "listForAuthor");
    Route::get("/task/status", "listForStatus");
    Route::get("/task/{id}", "read");
    Route::put("/task/{id}", "update");
    Route::delete("/task/{id}", "delete");
});