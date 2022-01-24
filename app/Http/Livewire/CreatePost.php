<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{

    use WithFileUploads;

    public $open = false;

    public $title, $content, $image, $identificador;

    protected $rules = [
        "title" => "required",
        "content" => "required",
        "image" => "required|image|max:2048"
    ];

    public function mount(){
        $this->identificador = rand();
    }

    public function save(){
        $this->validate();

        $image = $this->image->store('posts');

        Post::Create([
            "title" => $this->title,
            "content" => $this->content,
            "image" => $image
        ]);
        $this->reset(["open", "title", "content", "image"]);
        $this->identificador = rand();
        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'El post se creo satisfactoriamente');
    }

    // public function updated($propertyName){
    //     $this->validateOnly($propertyName);
    // }

    public function render()
    {
        return view('livewire.create-post');
    }

    public function updatingOpen(){
        if ($this->open == false) {
            $this->reset(['title', 'content', 'image']);
            $this->identificador = rand();
            $this->emit('resetCKEditor');
        }
    }

}
