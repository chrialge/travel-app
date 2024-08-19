<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StepController;
use App\Http\Controllers\Admin\TravelController;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowTravelController;
use App\Http\Controllers\VoteController;
use App\Models\Travel;
use Illuminate\Support\Facades\Route;

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
    $travels = Travel::all();
    return view('welcome', compact('travels'));
});

Route::get('/travels/{travel}', [ShowTravelController::class, 'show'])->name('travel');

Route::post('/{step}/vote', [VoteController::class, 'addVote'])->name('vote');

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/travels', TravelController::class)->parameters(['travels' => 'travel:slug']);
        Route::resource('/steps', StepController::class);
        Route::resource('/notes', NoteController::class);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
