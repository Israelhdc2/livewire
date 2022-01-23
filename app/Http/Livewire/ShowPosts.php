<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowPosts extends Component
{

    use WithFileUploads;

    public $open_edit = false;

    public $post, $image, $identificador;

    public $search;

    public $sort = 'id';
    public $direction = 'desc';

    protected $listeners = ["render"];

    protected $rules = [
        "post.title" => "required",
        "post.content" => "required"
    ];

    public function mount(){
        $this->post = new Post();
        $this->identificador = rand();
    }

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%')
                    ->orderBy($this->sort, $this->direction)->get();
        return view('livewire.show-posts', compact('posts'));
    }

    public function order($sort){

        $this->sort = $sort;
        if ($this->sort == $sort) {
            if ($this->direction == "desc") {
                $this->direction = "asc";
            } else {
                $this->direction = "desc";
            }
            
        } else {
            $this->sort = $sort;
            $this->direction = "asc";
        }       

    }

    public function close(){
        $this->reset(['open_edit', 'image']);
        $this->identificador = rand();
    }

    public function edit(Post $post){
        $this->post = $post;
        $this->open_edit = true;
    }

}
