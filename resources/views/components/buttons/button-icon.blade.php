@props([
'icon',
'label',
'action',
'color' => 'blue',
'id',
])


<div x-data="{ open: false }" class="relative inline-block p-1">
    <button wire:click="{{$action}}({{$id}})" @mouseenter="open = true" @mouseleave="open = false"
        class="px-2 py-1 rounded text-{{$color}}-500 border border-{{$color}}-700 hover:bg-{{$color}}-700 hover:text-white shadow-sm shadow-gray-400 dark:shadow-black transition duration-200">
        <i class="{{$icon}}"></i>
    </button>

    <div x-show="open" x-transition x-cloak
        class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded px-2 py-1">
        {{$label}}
    </div>
</div>