<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\LessonTeacher;
use App\Models\Lesson;
use App\Models\Major;
use App\Models\Grade;

class TeacherDetail extends Component
{
    public $teacher, $teacher_id, $lesson_teacher, $lesson_teacher_id, $lessons, $majors, $classes, $nuptk, $name, $address, $phone_number, $gender, $lesson_id, $class_id, $major_id;

    public $isModal = 0;

    public function mount(Teacher $teacher)
    {
        $this->teacher = $teacher;
        $this->teacher_id = $teacher->id;
        $this->getLessonTeacher();
    }

    public function render()
    {
        return view('livewire.teacher_details.index');
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

        $this->getLessons();
        $this->getMajors();
        $this->getClasses();
    }

    public function getLessonTeacher()
    {
        $this->lesson_teacher = LessonTeacher::with('lesson', 'teacher', 'grade')->where('teacher_id', $this->teacher_id)->get();
    }

    public function getLessons()
    {
        $this->lessons = Lesson::all();
    }

    public function getMajors()
    {
        $this->majors = Major::all();
    }

    public function getClasses()
    {
        $this->classes = Grade::all();
    }

    public function resetFields()
    {
        $this->lesson_id = '';
        $this->class_id = '';
        $this->major_id = '';

        $this->getLessonTeacher();
    }

    public function store()
    {
        $this->validate([
            'lesson_id' => 'required',
            'class_id' => 'required',
            'major_id' => 'required',
        ]);

        LessonTeacher::updateOrCreate(['id' => $this->lesson_teacher_id], [
            'teacher_id' => $this->teacher_id,
            'lesson_id' => $this->lesson_id,
            'major_id' => $this->major_id,
            'class_id' => $this->class_id,
        ]);

        session()->flash('message', $this->lesson_teacher_id ? 'Pelajaran Diperbaharui': 'Pelajaran Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $lesson = LessonTeacher::find($id);

        $this->lesson_teacher_id = $id;
        $this->lesson_id = $lesson->lesson_id;
        $this->major_id = $lesson->major_id;
        $this->class_id = $lesson->class_id;

        $this->openModal();
    }

    public function delete($id)
    {
        $teacher = LessonTeacher::find($id);
        $teacher->delete();
        $this->getLessonTeacher();
        session()->flash('message', 'Nilai Dihapus');
    }
}
