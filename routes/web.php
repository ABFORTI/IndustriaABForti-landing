<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');

Route::get('/contacto', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contacto', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::get('/{division}', [PageController::class, 'division'])
    ->whereIn('division', array_keys(config('divisions')))
    ->name('divisions.show');
