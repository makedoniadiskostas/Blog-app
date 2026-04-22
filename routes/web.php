<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [PostController::class, 'mainDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::resource('posts', PostController::class)->except([
    // php artisan route:list --except-vendor
    'index',
]);
Route::resource('tags', TagController::class)->except([
    'index', 'show'
]);
Route::get('/posts/tag/{tag}', [PostController::class, 'index'])->name('posts.tagged');

require __DIR__.'/auth.php';
