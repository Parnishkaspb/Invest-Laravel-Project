<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create_investition', [App\Http\Controllers\InvestitionController::class, 'index']);

Route::middleware('throttle:5,1')->group(function () {
    Route::post('/create_investition', [App\Http\Controllers\InvestitionController::class, 'create'])
         ->name('investition.create');
});

Route::get('/edit', [App\Http\Controllers\EditController::class, 'index'])->name('edit');

Route::post('/edit', [App\Http\Controllers\EditController::class, 'update'])->name('update');

Route::get('/info/{id}', [App\Http\Controllers\InfoInvestController::class, 'show']);
