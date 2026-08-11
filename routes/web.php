<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');


Route::get('/{division}', [PageController::class, 'division'])
    ->whereIn('division', array_keys(config('divisions')))
    ->name('divisions.show');
