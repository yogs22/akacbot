<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\StudentParent;

class Parents extends Component
{
    public $parents, $name, $religion, $address, $phone_number, $relation, $parent_id;
    public $isModal = 0;

    public function render()
    {
        $this->parents = StudentParent::orderBy('created_at', 'DESC')->get();
        return view('livewire.parents.index');
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
        $this->address = '';
        $this->phone_number = '';
        $this->relation = '';
        $this->parent_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'religion' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'relation' => 'required|string',
        ]);

        StudentParent::updateOrCreate(['id' => $this->parent_id], [
            'name' => $this->name,
            'religion' => $this->religion,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'relation' => $this->relation,
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

        $this->openModal();
    }

    public function delete($id)
    {
        $parent = StudentParent::find($id);
        $parent->delete();
        session()->flash('message', $parent->name . ' Dihapus');
    }
}
