<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{

    use WithFileUploads;

    public $open = false;

    public $title, $content, $image;

    protected $rules = [
        "title" => "required",
        "content" => "required",
        "image" => "required|image|max:2048"
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

    // public function updated($propertyName){
    //     $this->validateOnly($propertyName);
    // }

    public function render()
    {
        return view('livewire.create-post');
    }
}
