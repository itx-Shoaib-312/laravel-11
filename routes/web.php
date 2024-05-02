<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;


Route::get('/', function () {
    return view('welcome');
});
Route::controller(CrudController::class)->group(function () {
    Route::get('show-record', 'index')->name('get-record');
    Route::post('add-record',  'add_record')->name('add-record');
    Route::get('del-record/{id}',  'del_record')->name('del-record');
    Route::get('fetch_data/{id}',  'fetch_data')->name('fetch_data');
});

Route::controller(CategoriesController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
    Route::post('add-category', 'add_category')->name('add-category');
    Route::get('del-category/{id}',  'del_category')->name('del-category');
    Route::post('update-category/{id}',  'update_category')->name('update-category');
});
