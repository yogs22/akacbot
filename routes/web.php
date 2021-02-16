<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Majors;
use App\Http\Livewire\Lessons;
use App\Http\Livewire\ScoreCategories;
use App\Http\Livewire\Teachers;
use App\Http\Livewire\Classes;

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
    Route::get('lesson', Lessons::class)->name('lesson');
    Route::get('score_category', ScoreCategories::class)->name('score_category');
    Route::get('teacher', Teachers::class)->name('teacher');
    Route::get('class', Classes::class)->name('class');
});
