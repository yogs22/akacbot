<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Grade;

class Classes extends Component
{
    public $classes, $name, $sub, $class_id;
    public $isModal = 0;

    public function render()
    {
        $this->classes = Grade::orderBy('created_at', 'DESC')->get();
        return view('livewire.classes.index');
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
        $this->sub = '';
        $this->class_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|integer',
            'sub' => 'required|integer',
        ]);

        Grade::updateOrCreate(['id' => $this->class_id], [
            'name' => $this->name,
            'sub' => $this->sub,
        ]);

        session()->flash('message', $this->class_id ? 'Kelas Diperbaharui': 'Kelas Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $class = Grade::find($id);

        $this->class_id = $id;
        $this->name = $class->name;
        $this->sub = $class->sub;

        $this->openModal();
    }

    public function delete($id)
    {
        $class = Grade::find($id);
        $class->delete();
        session()->flash('message', $class->name . ' Dihapus');
    }
}
