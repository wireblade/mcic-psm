<?php


use App\Livewire\Page\Employees;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

// This is to redirect the root URL to the login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/map', function () {
    return view('map');
})->middleware(['auth']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('map/',  \App\Livewire\Map\Index::class)->name('map.index');
});

Route::get('map-view/', \App\Livewire\Map\MapView::class)->name('map.view');

require __DIR__ . '/auth.php';
