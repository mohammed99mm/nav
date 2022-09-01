<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\menuController;


Route::get('manage-menus/{id?}',[menuController::class,'index']);
Route::post('create-menu',[menuController::class,'store']);	
Route::get('add-categories-to-menu',[menuController::class,'addCatToMenu']);
Route::get('add-post-to-menu',[menuController::class,'addPostToMenu']);
Route::get('add-custom-link',[menuController::class,'addCustomLink']);	
Route::get('update-menu',[menuController::class,'updateMenu']);	
Route::post('update-menuitem/{id}',[menuController::class,'updateMenuItem']);
Route::get('delete-menuitem/{id}/{key}/{in?}',[menuController::class,'deleteMenuItem']);
Route::get('delete-menu/{id}',[menuController::class,'destroy']);	
