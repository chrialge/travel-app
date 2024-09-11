<?php

use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('date-travel/{travel:id}', function ($id) {
    $travel = Travel::where('id', $id)->first();

    // creo una varibile con un array vuoto
    $dateArray = [];

    // salvo nella variabile la data d'inizio del viaggio trasformato in datetime 
    $begin = new DateTime($travel->date_start);
    $begin = $begin->format('d/m/Y');
    // salvo nella variabile la data formattata

    // salvo nella variabile la dat di fine del viaggio trasformato in dateTime
    $end = new DateTime($travel->date_finish);
    $end = $end->format('d/m/Y');

    $dateArray = [
        'begin' => $begin,
        'end' => $end,
    ];

    return response()->json([
        'success' => 'success',
        'response' => $dateArray
    ]);
});
