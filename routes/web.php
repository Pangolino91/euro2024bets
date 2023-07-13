<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BetController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/fixtures', [FixtureController::class, 'index'])->middleware(['auth', 'verified'])->name('fixtures');

Route::post('/fixtures', [FixtureController::class, 'place_bet'])
    ->middleware(['auth', 'verified'])
    ->name('fixtures.place_bet');

Route::get('/fixtures/{fixture_id}', [FixtureController::class, 'match_details'])
    ->middleware(['auth', 'verified'])
    ->name('fixtures.details');

Route::get('/leaderboard', [BetController::class, 'leaderboard'])->middleware(['auth', 'verified'])->name('leaderboard');


Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('admin');
Route::get('/admin/leaderboard', [AdminController::class, 'leaderboard'])->middleware(['auth', 'admin'])->name('admin.leaderboard');
Route::get('/admin/match-fixture', [AdminController::class, 'match_fixture'])->middleware(['auth', 'admin'])->name('admin.match-fixture');
Route::post('/admin/match-fixture', [AdminController::class, 'create_fixture'])
    ->middleware(['auth', 'admin'])
    ->name('admin.create_fixture');
Route::match(['get', 'post'], '/admin/match-results/{fixture_id}', [AdminController::class, 'set_fixture_results'])
    ->middleware(['auth', 'admin'])
    ->name('admin.set_results');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
