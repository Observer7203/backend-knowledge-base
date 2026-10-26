<?php

use App\Http\Controllers\KbPageController;
use App\Http\Controllers\KbSearchController;
use App\Http\Middleware\KbLayoutChecker;
use Illuminate\Support\Facades\Route;

// Хаб
Route::get('/', [KbPageController::class, 'home'])
    ->middleware(KbLayoutChecker::class)
    ->name('kb.home');

// Поиск по тексту разделов: отвечает выпадающему списку в шапке
Route::get('/kb-search', KbSearchController::class)->name('kb.search');

// Английская версия: тот же контроллер, другой язык и другие вью.
// Идёт до общего /{slug}, иначе «en» будет принят за slug страницы.
Route::get('/en', fn () => app(KbPageController::class)->home('en'))
    ->middleware(KbLayoutChecker::class)
    ->name('kb.home.en');

Route::get('/en/{slug}', fn (string $slug) => app(KbPageController::class)->show($slug, 'en'))
    ->where('slug', '[A-Za-z0-9_-]+')
    ->middleware(KbLayoutChecker::class)
    ->name('kb.page.en');

// KB-страница по slug (slug соответствует полю slug в таблице modules)
Route::get('/{slug}', [KbPageController::class, 'show'])
    ->where('slug', '[A-Za-z0-9_-]+')
    ->middleware(KbLayoutChecker::class)
    ->name('kb.page');

// Обратная совместимость со старыми .html-URL → 301 редирект на чистые
Route::get('/index.html', fn() => redirect('/', 301));
Route::get('/{slug}.html', fn(string $slug) => redirect("/{$slug}", 301))
    ->where('slug', '[A-Za-z0-9_-]+');
