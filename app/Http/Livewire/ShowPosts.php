<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPosts extends Component
{

    public $post;

    public $search;

    public $sort = 'id';
    public $direction = 'desc';

    protected $listeners = ["render"];

    public function mount(){
        $this->post = new Post();
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

    public function edit(Post $post){
        $this->post = $post;
    }

}
