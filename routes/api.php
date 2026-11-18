<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::get("/postUser/{post}", [PlaceController::class, "post"]);
    Route::post("/postadd", [PlaceController::class, "postadd"]);
    Route::post("/postedit/{post}", [PlaceController::class, "postedit"]);
    Route::post("/comment/{post}", [CommentController::class, "store"]);
});
Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::get("/placesHome", [PlaceController::class, "placesHome"]);




// Route::get("/homepage", [UserController::class, "homepage"])->name('homepage');
// Route::post("/register", [UserController::class, "register"])->name('register');
// Route::get("/login", [UserController::class, "login"])->name('login');
// Route::get("/logout", [UserController::class, "logout"])->name('logout');
// Route::get("/viewregister", [UserController::class, "viewregister"])->name('viewregister');
// Route::get("/viewlogin", [UserController::class, "viewlogin"])->name('viewlogin');
// Route::get("/userprofileview", [UserController::class, "userprofileview"])->name('userprofileview');
// Route::get("/adminpanel/{page}", [UserController::class, "adminpanel"])->name('adminpanel');

// Route::get("/orderview", [OrderController::class, "orderview"])->name('orderview');
// Route::post("/orderform", [OrderController::class, "orderform"])->name('orderform');
// Route::get("/order", [OrderController::class, 'order'])->name('order');
// Route::get("/orderedit/{orderid}", [OrderController::class, 'orderedit'])->name('orderedit');

// Route::post("/placeform", [PlaceController::class, "placeform"])->name('placeform');
// Route::post("/placeupdate/{place}", [PlaceController::class, "placeupdate"])->name('placeupdate');
// Route::get("/placedelete/{placeid}", [PlaceController::class, "placedelete"])->name('placedelete');
// Route::get("/placeview/{placeid}", [PlaceController::class, "placeview"])->name('placeview');

// Route::post("/comment/{orderid}", [CommentController::class, "comment"])->name('comment');
// Route::get("/commentview/{orderid}", [CommentController::class, "commentview"])->name('commentview');