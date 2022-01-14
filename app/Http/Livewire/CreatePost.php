<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{

    public $open = false;

    public $title;
    public $content;

    public function save(){
        Post::Create([
            "title" => $this->title,
            "content" => $this->content
        ]);
        $this->emit('render');
        $this->emit('alert', 'El post se creo satisfactoriamente');
        $this->reset(["open", "title", "content"]);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}