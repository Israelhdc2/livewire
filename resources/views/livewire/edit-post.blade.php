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
                <x-jet-label for="Titulo del Post" />
                <x-jet-input type="text" class="w-full" />
            </div>
            <div class="mb-4">
                <x-jet-label for="Contenido del Post" />
                <textarea rows="6" class="form-control w-full"></textarea>
            </div>
        </x-slot>
        <x-slot name="footer">
    
        </x-slot>
    </x-jet-dialog-modal>

</div>


