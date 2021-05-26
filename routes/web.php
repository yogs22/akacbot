<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Majors;
use App\Http\Livewire\Lessons;
use App\Http\Livewire\ScoreCategories;
use App\Http\Livewire\Teachers;
use App\Http\Livewire\Classes;
use App\Http\Livewire\Parents;
use App\Http\Livewire\Students;
use App\Http\Livewire\StudentDetail;
use App\Http\Livewire\TeacherDetail;
use App\Http\Livewire\Chatbot;
use App\Http\Livewire\Documentation;

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
    Route::get('class', Classes::class)->name('class');
    Route::get('parent', Parents::class)->name('parent');

    // Teacher Route
    Route::get('teacher/{teacher}', TeacherDetail::class)->name('teacher.detail');
    Route::get('teacher', Teachers::class)->name('teacher');

    // Student route
    Route::get('student/{student}', StudentDetail::class)->name('student.detail');
    Route::get('student', Students::class)->name('student');

    // Chatbot
    Route::get('chatbot', Chatbot::class)->name('chatbot');

    // Documentation
    Route::get('documentation', Documentation::class)->name('documentation');
});
Route::post('chatbot', [Chatbot::class, 'store'])->name('chatbot.store');
