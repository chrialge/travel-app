<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StepController;
use App\Http\Controllers\Admin\TravelController;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\CreateNoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowImageConteroller;
use App\Http\Controllers\ShowTravelController;
use App\Http\Controllers\VoteController;
use App\Models\Travel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowStepController;

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

Route::get('/travels/{travel:slug}', [ShowTravelController::class, 'show'])->name('travel');

Route::post('/{step}/vote', [VoteController::class, 'addVote'])->name('vote');

Route::get('/steps/{step:slug}', [ShowStepController::class, 'show'])->name('step');

Route::post('/steps/notes', [CreateNoteController::class, 'index'])->name('note');

route::get('/image', [ShowImageConteroller::class, 'showImage'])->name('image');


Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/travels', TravelController::class)->parameters(['travels' => 'travel:slug']);
        Route::resource('/steps', StepController::class)->parameters(['steps' => 'step:slug']);
        Route::resource('/notes', NoteController::class)->parameters(['notes' => 'note:slug']);
        Route::get('/search-travels', [TravelController::class, 'search'])->name('search.travels');
        Route::get('/search-steps', [StepController::class, 'search'])->name('search.steps');
        Route::get('/search-notes', [NoteController::class, 'search'])->name('search.notes');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
