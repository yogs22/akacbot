<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Teacher;

class Teachers extends Component
{
    public $teachers, $name, $nuptk, $address, $phone_number, $gender, $teacher_id;
    public $isModal = 0;

    public function render()
    {
        $this->teachers = Teacher::orderBy('created_at', 'DESC')->get();
        return view('livewire.teachers.index');
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
    }

    public function resetFields()
    {
        $this->name = '';
        $this->nuptk = '';
        $this->address = '';
        $this->phone_number = '';
        $this->gender = '';
        $this->teacher_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'nuptk' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'gender' => 'required|string',
        ]);

        Teacher::updateOrCreate(['id' => $this->teacher_id], [
            'name' => $this->name,
            'nuptk' => $this->nuptk,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
        ]);

        session()->flash('message', $this->teacher_id ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);

        $this->teacher_id = $id;
        $this->name = $teacher->name;
        $this->nuptk = $teacher->nuptk;
        $this->address = $teacher->address;
        $this->phone_number = $teacher->phone_number;
        $this->gender = $teacher->gender;

        $this->openModal();
    }

    public function delete($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        session()->flash('message', $teacher->name . ' Dihapus');
    }
}
