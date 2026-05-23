<?php

use App\Http\Controllers\KbPageController;
use Illuminate\Support\Facades\Route;

// Хаб
Route::get('/', [KbPageController::class, 'home'])->name('kb.home');

// KB-страница по slug (slug соответствует полю slug в таблице modules)
Route::get('/{slug}', [KbPageController::class, 'show'])
    ->where('slug', '[A-Za-z0-9_-]+')
    ->name('kb.page');

// Обратная совместимость со старыми .html-URL → 301 редирект на чистые
Route::get('/index.html', fn() => redirect('/', 301));
Route::get('/{slug}.html', fn(string $slug) => redirect("/{$slug}", 301))
    ->where('slug', '[A-Za-z0-9_-]+');
