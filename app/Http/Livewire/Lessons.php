<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lesson;

class Lessons extends Component
{
    public $name, $code, $lesson_id;
    public $isModal = 0;

    public function render()
    {
        return view('livewire.lessons.index', [
            'lessons' => Lesson::latest()->paginate()
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
        $this->lesson_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'code' => 'required|string',
        ]);

        Lesson::updateOrCreate(['id' => $this->lesson_id], [
            'name' => $this->name,
            'code' => $this->code,
        ]);

        session()->flash('message', $this->lesson_id ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $lesson = Lesson::find($id);

        $this->lesson_id = $id;
        $this->name = $lesson->name;
        $this->code = $lesson->code;

        $this->openModal();
    }

    public function delete($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
        session()->flash('message', $lesson->name . ' Dihapus');
    }
}
