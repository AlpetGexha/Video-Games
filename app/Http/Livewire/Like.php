<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Maize\Markable\Models\Like as Likeable;

class Like extends Component
{

    public $model;

    public function mount($model)
    {
        $this->model = $model;
    }

    public function like()
    {
        Likeable::add($this->model, auth()->user());
    }
    public function render()
    {
        return view('livewire.like');
    }
}
