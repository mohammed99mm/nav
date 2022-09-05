<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\menuController;


Route::get('manage-menus{id?}',[menuController::class,'index'])->name('manage-menus');
Route::post('create-menu',[menuController::class,'store'])->name('create-menu');
Route::get('add-categories-to-menu',[menuController::class,'addCatToMenu'])->name('add-categories-to-menu');
Route::get('add-post-to-menu',[menuController::class,'addPostToMenu'])->name('add-post-to-menu');
Route::get('add-custom-link',[menuController::class,'addCustomLink'])->name('add-custom-link');	
Route::get('update-menu',[menuController::class,'updateMenu'])->name('update-menu');
Route::post('update-menuitem/{id}',[menuController::class,'updateMenuItem'])->name('update-menuitem');
Route::get('delete-menuitem/{id}/{key?}/{in1?}/{in2?}/{in3?}/{in4?}',[menuController::class,'deleteMenuItem'])->name('delete-menuitem');
Route::get('delete-menu/{id}',[menuController::class,'destroy'])->name('delete-menu');	
