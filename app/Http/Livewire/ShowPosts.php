<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $open_edit = false;

    public $post, $image, $identificador;

    public $search;

    public $sort = 'id';
    public $direction = 'desc';

    public $cant = '10';

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
                    ->orderBy($this->sort, $this->direction)->paginate($this->cant);
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

    public function update(){
        $this->validate();
        if ($this->image) {
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');
        }
        $this->post->save();
        $this->reset(['open_edit', 'image']);
        $this->identificador = rand();
        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'El post se actualizo satisfactoriamente');
        
    }

    public function updatingSearch(){
        $this->resetPage();
    }

}
