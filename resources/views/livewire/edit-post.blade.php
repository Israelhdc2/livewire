<div>
    <a class="btn btn-green" wire:click="$set('open', true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar post
        </x-slot>
        <x-slot name="content">

            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando!</strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado</span>                
            </div>

            @if ($image)
                <img src="{{$image->temporaryUrl()}}" class="mb-4">
            @elseif($post->image)
                <img src="{{Storage::url($post->image)}}" class="mb-4">
            @endif

            <div class="mb-4">
                <x-jet-label value="Titulo del Post" />
                <x-jet-input type="text" class="w-full" wire:model="post.title" />
                <x-jet-input-error for="post.title" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Contenido del Post" />
                <textarea rows="6" class="form-control w-full" wire:model="post.content"></textarea>
                <x-jet-input-error for="post.content" />
            </div>

            <div>
                <input type="file" wire:model="image" id="{{$identificador}}" />
                <x-jet-input-error for="image" />
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="close()">Cancelar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-25">Actualizar</x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>


