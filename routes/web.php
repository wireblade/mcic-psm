<?php

use App\Http\Controllers\MapDataController;
use App\Livewire\Page\Employees;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Codes;
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

Route::get('/dashboard', function () {
    return redirect('/projects');
})->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('settings/code', Codes::class)->name('settings.code');

    Route::get('projects/',  \App\Livewire\Map\Index::class)->name('map.index');
    Route::get('finished-projects/', \App\Livewire\Map\FinishedProject::class)->name('map.finished');
    Route::get('projects/files/{id}', \App\Livewire\Map\Files::class)->name('project.files');
});


Route::get('map-view/', \App\Livewire\Map\MapView::class)->name('map.view');
Route::get('map-view-finished/', \App\Livewire\Map\MapViewFinished::class)->name('map.complete');

Route::get('/map/projects.geojson', [MapDataController::class, 'projects']);
Route::get('/map/finishedProject.geojson', [MapDataController::class, 'finishedProject']);

require __DIR__ . '/auth.php';
