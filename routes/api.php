<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::post("/orderadd/{place}", [OrderController::class, "orderadd"]);
    Route::get("/orderUser", [OrderController::class, "orderUser"]);
    Route::get("/orderAdmin", [OrderController::class, "orderAdmin"]);
    Route::post("/orderedit/{order}", [OrderController::class, "orderedit"]);
    Route::post("/placeadd", [PlaceController::class, "placeadd"]);
    Route::delete("/placedelete/{place}", [PlaceController::class, "placedelete"]);
    Route::post("/placeedit/{place}", [PlaceController::class, "placeedit"]);
    Route::post("/comment/{place}", [CommentController::class, "comment"]);
});
Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::get("/placesHome", [PlaceController::class, "placesHome"]);
Route::get("/place/{place}", [PlaceController::class, "place"]);