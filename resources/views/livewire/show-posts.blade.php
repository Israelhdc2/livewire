<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <x-table>

            <div class="px-6 py-4 flex items-center">
                <x-jet-input type="text" placeholder="Escriba lo que quiera buscar" class="flex-1 mr-4" wire:model="search" />
                
                @livewire('create-post')

            </div>

            @if ($posts->count())
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
                                        {{$item->content}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">                                    
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                    <a class="btn btn-green" wire:click="edit({{$item}})"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
        
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    No existe ningun registro coincidente
                </div>                
            @endif

        </x-table>
    </div>

</div>
