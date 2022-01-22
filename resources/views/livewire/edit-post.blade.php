<div>
    <a class="btn btn-green" wire:click="$set('open', true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar
        </x-slot>
        <x-slot name="content">
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
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">Cancelar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">Actualizar</x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>


