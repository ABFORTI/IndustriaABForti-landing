<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');

// Páginas propias por división: /industria, /logistica, /inmobiliaria.
// El wildcard queda restringido a los slugs definidos en config/divisions.php,
// así config/divisions.php sigue siendo la única fuente de verdad.
Route::get('/{division}', [PageController::class, 'division'])
    ->whereIn('division', array_keys(config('divisions')))
    ->name('divisions.show');
