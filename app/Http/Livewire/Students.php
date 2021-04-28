<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Major;
use App\Models\Grade;

class Students extends Component
{
    public $students, $student, $name, $nisn, $address, $birthplace, $birthdate, $phone_number, $gender, $religion, $parent_id, $major_id, $student_id, $class_id;

    public $isModal = 0;

    public $parents = null;
    public $majors = null;
    public $classes = null;

    public function render()
    {
        $this->students = Student::with(['major', 'parent'])->orderBy('created_at', 'DESC')->get();
        return view('livewire.students.index');
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

        $this->getStudentParents();
        $this->getGrades();
        $this->getMajors();
    }

    public function getStudentParents()
    {
        $this->parents = StudentParent::all();
    }

    public function getGrades()
    {
        $this->classes = Grade::all();
    }

    public function getMajors()
    {
        $this->majors = Major::all();
    }

    public function resetFields()
    {
        $this->nisn = '';
        $this->name = '';
        $this->address = '';
        $this->phone_number = '';
        $this->birthplace = '';
        $this->birthdate = '';
        $this->gender = '';
        $this->religion = '';
        $this->parent_id = '';
        $this->major_id = '';
        $this->student_id = '';
        $this->class_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'nisn' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'birthplace' => 'required|string',
            'birthdate' => 'required|date',
            'religion' => 'required|string',
            'major_id' => 'required|integer',
            'parent_id' => 'required|integer',
            'gender' => 'required|string',
            'class_id' => 'required|integer',
        ]);

        Student::updateOrCreate(['id' => $this->student_id], [
            'name' => $this->name,
            'nisn' => $this->nisn,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'birthplace' => $this->birthplace,
            'birthdate' => $this->birthdate,
            'religion' => $this->religion,
            'parent_id' => $this->parent_id,
            'major_id' => $this->major_id,
            'class_id' => $this->class_id,
        ]);

        session()->flash('message', $this->student_id ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function show($id)
    {
        $student = Student::find($id);

        return view('livewire.students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::find($id);

        $this->student_id = $id;
        $this->nisn = $student->nisn;
        $this->name = $student->name;
        $this->address = $student->address;
        $this->phone_number = $student->phone_number;
        $this->birthplace = $student->birthplace;
        $this->birthdate = $student->birthdate;
        $this->gender = $student->gender;
        $this->religion = $student->religion;
        $this->parent_id = $student->parent_id;
        $this->major_id = $student->major_id;
        $this->class_id = $student->class_id;

        $this->openModal();
    }

    public function delete($id)
    {
        $student = Student::find($id);
        $student->delete();
        session()->flash('message', $student->name . ' Dihapus');
    }
}
