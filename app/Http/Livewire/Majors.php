<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Major;

class Majors extends Component
{
    public $name, $code, $major_id;
    public $isModal = 0;

    public function render()
    {
        return view('livewire.majors.index', [
            'majors' => Major::latest()->paginate()
        ]);
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
        $this->code = '';
        $this->major_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'code' => 'required|string',
        ]);

        Major::updateOrCreate(['id' => $this->major_id], [
            'name' => $this->name,
            'code' => $this->code,
        ]);

        session()->flash('message', $this->major_id ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $major = Major::find($id);

        $this->major_id = $id;
        $this->name = $major->name;
        $this->code = $major->code;

        $this->openModal();
    }

    public function delete($id)
    {
        $major = Major::find($id);
        $major->delete();
        session()->flash('message', $major->name . ' Dihapus');
    }
}
