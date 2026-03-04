<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DépenseController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ... tes autres routes (breeze, etc.)

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/colocations', [ColocationController::class, 'index'])->name('colocation.index');
    Route::get('/colocations/create', [ColocationController::class, 'create'])->name('colocation.create');
    Route::post('/colocations', [ColocationController::class, 'store'])->name('colocation.store');
    Route::delete('/colocations/{colocation}', [ColocationController::class, 'destroy'])->name('colocation.destroy');

    Route::get('/dépenses/create', [DépenseController::class, 'create'])->name('dépense.create');
    Route::post('/dépenses', [DépenseController::class, 'store'])->name('dépense.store');


    Route::post('/colocations/{colocation}/invite', [ColocationController::class, 'invite'])->name('colocation.invite');
    Route::get('/colocations/join/{token}', [ColocationController::class, 'join'])->name('colocation.join');
});