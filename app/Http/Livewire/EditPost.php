<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class EditPost extends Component
{

    public $post;

    public $open = false;

    protected $rules = [
        "post.title" => "required",
        "post.content" => "required"
    ];

    public function mount(Post $post){
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.edit-post');
    }

    public function save(){
        $this->validate();
        $this->post->save();
        $this->reset(['open']);
        $this->emitTo('show-post', 'render');
        $this->emit('alert', 'El post se actualizo satisfactoriamente');        
    }

}
