<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\StudentParent;
use App\Models\Student;

class Parents extends Component
{
    public $name, $religion, $address, $phone_number, $relation, $parent_id, $student_id;
    public $isModal = 0;

    public $students;

    public function render()
    {
        return view('livewire.parents.index', [
            'parents' => StudentParent::latest()->paginate(15)
        ]);
    }

    public function getStudents()
    {
        $this->students = Student::all();
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

        $this->getStudents();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->address = '';
        $this->phone_number = '';
        $this->relation = '';
        $this->parent_id = '';
        $this->student_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'religion' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'relation' => 'required|string',
            'student_id' => 'required|integer',
        ]);

        $parent = StudentParent::updateOrCreate(['id' => $this->parent_id], [
            'name' => $this->name,
            'religion' => $this->religion,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'relation' => $this->relation,
            'student_id' => $this->student_id
        ]);

        session()->flash('message', $this->parent_id ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $parent = StudentParent::find($id);

        $this->parent_id = $id;
        $this->name = $parent->name;
        $this->religion = $parent->religion;
        $this->address = $parent->address;
        $this->phone_number = $parent->phone_number;
        $this->relation = $parent->relation;
        $this->student_id = $parent->student_id;

        $this->openModal();
    }

    public function delete($id)
    {
        $parent = StudentParent::find($id);
        $parent->delete();
        session()->flash('message', $parent->name . ' Dihapus');
    }
}
