<?php

namespace App\Livewire\ToDo;

use App\Models\ToDo\Lists;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateTodoList extends Component
{
    public $title;

    public $description;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    public function submit()
    {
        $this->validate();

        Lists::create([
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => Auth::id(),
        ]);

        session()->flash('success', 'List created successfully');

        return redirect()->route('lists');
    }

    public function render()
    {
        return view('livewire.to-do.create-todo-list');
    }
}
