<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use BotMan\BotMan\BotMan;
use Livewire\Component;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Models\Score;
use App\Models\Student;
use App\Models\StudentParent;
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
            $this->getScore($botman);

            $this->fallback($botman);

            $botman->listen();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
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

    /**
     * Get student parent with nim/nisn
     * @param  BotMan $botman
     * @return BotMan $botman
     */
    public function getParent($botman)
    {
        $botman->hears('Data wali siswa dengan (nisn|nama) {object}', function($bot, $object) {
            $parents = StudentParent::with('student')->whereHas('student', function (Builder $query) use ($object) {
                $query->where('name', 'like', "%{$object}%")->orWhere('nisn', $object);
            })
            ->get();

            if (count($parents) == 0) {
                $bot->reply('Data wali murid yang anda maksud tidak ditemukan');
            } else {
                foreach ($parents as $parent) {
                    $bot->reply("
                        Nama: {$parent->name} <br>
                        Alamat: {$parent->address} <br>
                        Tanggal Lahir: {$parent->date_formated} <br>
                        No HP: {$parent->phone_number} <br>
                        Agama: {$parent->religion} <br>
                        Status: {$parent->relation}
                    ");
                }
            }
        });
    }

    /**
     * Get student score with nim/nisn
     * @param  BotMan $botman
     * @return BotMan $botman
     */
    public function getScore($botman)
    {
        $botman->hears('Nilai pelajaran {adjective} dengan nisn {nisn}', function($bot, $adjective, $nisn) {
            $scores = Score::select('semester', 'value', 'score_category_id')->with('scoreCategory:id,name')
            ->whereHas('lesson', function (Builder $query) use ($adjective) {
                $query->where('name', $adjective);
            })
            ->whereHas('student', function (Builder $query) use ($nisn) {
                $query->where('nisn', $nisn);
            })
            ->get();

            if (count($scores) == 0) {
                $bot->reply('Data nilai yang anda maksud tidak ditemukan');
            } else {
                $scoreGrouped = $scores->groupBy('semester');
                foreach ($scoreGrouped->toArray() as $score) {
                    $semester = "Nilai semester {$score[0]['semester']} : <br>";
                    $value = null;
                    foreach ($score as $sc) {
                        $value .= $sc['score_category']['name'] .' : '. $sc['value'] . '<br>';
                    }
                    $bot->reply($semester.$value);
                }
            }
        });
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
}
