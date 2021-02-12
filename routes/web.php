<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Majors;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('major', Majors::class)->name('major');
});
