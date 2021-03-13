<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\ScoreCategory;
use App\Models\Lesson;
use App\Models\Score;

class StudentDetail extends Component
{
    public $student, $scores, $score_id, $student_id, $lesson_id, $value, $semester, $score_category_id;

    public $isModal = 0;

    public $score_categories = null;
    public $lessons = null;

    public function mount(Student $student)
    {
        $this->student = $student;
        $this->student_id = $student->id;
    }

    public function render()
    {
        $this->scores = Score::where('student_id', $this->student_id)->select('*')->orderBy('semester')->get();

        return view('livewire.student_details.index');
    }

    public function create()
    {
        $this->resetFields();

        $this->openModal();
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function openModal()
    {
        $this->isModal = true;

        $this->getScoreCategories();
        $this->getLessons();
    }

    public function getScoreCategories()
    {
        $this->score_categories = ScoreCategory::all();
    }

    public function getLessons()
    {
        $this->lessons = Lesson::all();
    }

    public function resetFields()
    {
        $this->score_id = '';
        $this->lesson_id = '';
        $this->value = '';
        $this->semester = '';
        $this->score_category_id = '';
    }

    public function store()
    {
        $this->validate([
            'lesson_id' => 'required',
            'value' => 'required',
            'semester' => 'required',
            'score_category_id' => 'required',
        ]);

        Score::updateOrCreate(['id' => $this->score_id], [
            'student_id' => $this->student_id,
            'lesson_id' => $this->lesson_id,
            'value' => $this->value,
            'semester' => $this->semester,
            'score_category_id' => $this->score_category_id,
        ]);

        session()->flash('message', $this->score_id ? 'Nilai Diperbaharui': 'Nilai Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $student = Score::find($id);

        $this->score_id = $id;
        $this->student_id = $student->student_id;
        $this->lesson_id = $student->lesson_id;
        $this->value = $student->value;
        $this->semester = $student->semester;
        $this->score_category_id = $student->score_category_id;

        $this->openModal();
    }

    public function delete($id)
    {
        $student = Score::find($id);
        $student->delete();
        session()->flash('message', 'Nilai Dihapus');
    }
}
