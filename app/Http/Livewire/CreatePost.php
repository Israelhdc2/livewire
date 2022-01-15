<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{

    public $open = false;

    public $title;
    public $content;

    protected $rules = [
        "title" => "required|max:100",
        "content" => "required|min:100"
    ];

    public function save(){
        $this->validate();
        Post::Create([
            "title" => $this->title,
            "content" => $this->content
        ]);
        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'El post se creo satisfactoriamente');
        $this->reset(["open", "title", "content"]);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
