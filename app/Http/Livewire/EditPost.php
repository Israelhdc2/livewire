<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPost extends Component
{

    use WithFileUploads;

    public $post, $image, $identificador;

    public $open = false;

    protected $rules = [
        "post.title" => "required",
        "post.content" => "required"
    ];

    public function mount(Post $post){
        $this->post = $post;
        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.edit-post');
    }

    public function save(){
        $this->validate();
        $this->post->save();
        $this->reset(['open', 'image']);
        $this->identificador = rand();
        $this->emitTo('show-post', 'render');
        $this->emit('alert', 'El post se actualizo satisfactoriamente');        
    }

}
