<?php

namespace App\Http\Livewire;

use BotMan\BotMan\BotMan;
use Livewire\Component;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Models\Student;
use Illuminate\View\View;

class Chatbot extends Component
{
    /**
     * Render chabot blade
     * @return View
     */
    public function render()
    {
        return view('chatbot');
    }

    /**
     * Store a conversations
     * @return BotMan $botman
     */
    public function store()
    {
        try {
            $botman  = app('botman');

            $this->getStudent($botman);
            $this->getParent($botman);

            $this->fallback($botman);

            $botman->listen();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Fallback message when message not found
     * @param  Object $botman
     * @return BotMan $botman
     */
    public function fallback($botman)
    {
        $botman->fallback(function($bot) {
            $bot->reply('Mohon maaf, pertanyaan tidak tersedia');
        });
    }

    /**
     * Get student data with NIM / name
     * @return BotMan $botman
     */
    public function getStudent($botman)
    {
        $botman->hears('Data siswa dengan (nisn|nama) {object}', function($bot, $object) {
            $student = Student::with('major')->where('name', 'like', "%{$object}%")
                ->orWhere('nisn', $object)
                ->first();

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
    }

    public function getParent($botman)
    {
        $botman->hears('Data wali siswa dengan (nisn|nama) {object}', function($bot, $object) {
            $student = Student::with('major')->where('name', 'like', "%{$object}%")
                ->orWhere('nisn', $object)
                ->first();

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
    }
}
