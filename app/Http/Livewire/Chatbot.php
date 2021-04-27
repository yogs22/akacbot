<?php

namespace App\Http\Livewire;

use BotMan\BotMan\BotMan;
use Livewire\Component;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Models\Student;

class Chatbot extends Component
{
    public function render()
    {
        return view('chatbot');
    }

    public function store()
    {
        try {
            $botman  = app('botman');

            $botman->hears('Data siswa dengan NISN {nisn}', function($bot, $nisn) {
                $student = Student::where('nisn', $nisn)->first();

                if (empty($student)) {
                    $bot->reply('Data siswa yang anda maksud tidak ditemukan');
                } else {
                    $bot->reply("
                        Nama: {$student->name} <br>
                        NISN: {$student->nisn} <br>
                        Jenis Kelamin: {$student->gender} <br>
                        Jurusan: {$student->major->name} <br>
                        Kelas: {$student->full_grade} <br>
                        Tempat Lahir: {$student->birthplace} <br>
                        Tanggal Lahir: {$student->date_formated} <br>
                        No HP: {$student->phone_number} <br>
                        Agama: {$student->religion}
                    ");
                }
            });

            $botman->fallback(function($bot) {
                $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
            });

            $botman->listen();
        } catch (\Exception $e) {
            return $e;
        }

    }
}
