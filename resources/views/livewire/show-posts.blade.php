<div wire:init="loadPosts">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <x-table>

            <div class="px-6 py-4 flex items-center">

                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select class="form-control mx-2" wire:model="cant">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entradas</span>
                </div>

                <x-jet-input type="text" placeholder="Escriba lo que quiera buscar" class="flex-1 mx-4" wire:model="search" />
                
                @livewire('create-post')

            </div>

            {{-- @if ($posts->count()) --}}
            @if (count($posts))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">
                                ID
                                @if ($sort == "id")
                                    @if ($direction == "asc")
                                        <span class="fas fa-sort-alpha-up-alt float-right mt-1"></span>
                                    @else
                                        <span class="fas fa-sort-alpha-down-alt float-right mt-1"></span>
                                    @endif
                                @else
                                    <span class="fas fa-sort float-right mt-1"></span>
                                @endif
                            </th>
                            <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('title')">
                                Title
                                @if ($sort == "title")
                                    @if ($direction == "asc")
                                        <span class="fas fa-sort-alpha-up-alt float-right mt-1"></span>
                                    @else
                                        <span class="fas fa-sort-alpha-down-alt float-right mt-1"></span>
                                    @endif
                                @else
                                    <span class="fas fa-sort float-right mt-1"></span>
                                @endif
                            </th>
                            <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('content')">
                                Content
                                @if ($sort == "content")
                                    @if ($direction == "asc")
                                        <span class="fas fa-sort-alpha-up-alt float-right mt-1"></span>
                                    @else
                                        <span class="fas fa-sort-alpha-down-alt float-right mt-1"></span>
                                    @endif
                                @else
                                    <span class="fas fa-sort float-right mt-1"></span>
                                @endif
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($posts as $item)
                            
                            <tr>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">
                                        {{$item->id}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">
                                        {{$item->title}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">
                                        {!! $item->content !!}                                        
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                    <a class="btn btn-green" wire:click="edit({{$item}})"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-red ml-2" ><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
        
                        @endforeach
                    </tbody>
                </table>

                @if ($posts->hasPages())
                    <div class="px-6 py-3">
                        {{$posts->links()}}
                    </div>
                @endif

            @else
                <div class="px-6 py-4">
                    No existe ningun registro coincidente
                </div>
            @endif

        </x-table>

    </div>

    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Editar Post
        </x-slot>
        <x-slot name="content">

            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando!</strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado</span>
            </div>

            @if ($image)
                <img src="{{$image->temporaryUrl()}}" class="mb-4">
            @elseif ($post->image)
                <img src="{{Storage::url($post->image)}}" class="mb-4" >
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
                <input type="file" wire:model="image" id="{{$identificador}}">
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="close()">Cancelar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update, image" class="disabled:opacity-25">Actualizar</x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
