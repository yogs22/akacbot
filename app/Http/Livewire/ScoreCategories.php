<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ScoreCategory;

class ScoreCategories extends Component
{
    public $score_categories, $name, $score_category_id;
    public $isModal = 0;

    public function render()
    {
        $this->score_categories = ScoreCategory::orderBy('created_at', 'DESC')->get();
        return view('livewire.score_categories.index');
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
        $this->score_category_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        ScoreCategory::updateOrCreate(['id' => $this->score_category_id], [
            'name' => $this->name,
        ]);

        session()->flash('message', $this->score_category_id ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $score_category = ScoreCategory::find($id);

        $this->score_category_id = $id;
        $this->name = $score_category->name;

        $this->openModal();
    }

    public function delete($id)
    {
        $score_category = ScoreCategory::find($id);
        $score_category->delete();
        session()->flash('message', $score_category->name . ' Dihapus');
    }
}
