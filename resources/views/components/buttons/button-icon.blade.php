@props([
'type' => 'primary',
'click' => 'null',
'label' => '',
'popup' => '',
'id' => '',
'icon' => '',
'action' => null,
'px' => '',
])

@php
$styles = [
'default' => 'rounded-md border-gray-500 text-gray-500 hover:bg-gray-700 hover:text-white',
'primary' => 'rounded-md border-blue-500 text-blue-500 hover:bg-blue-700 hover:text-white',
'danger' => 'rounded-md bg-red-500 text-white hover:bg-red-700',
'success' => 'rounded-md bg-green-500 text-white hover:bg-green-700',
'menu' => 'bg-transparent',
];

$class = $styles[$type] ?? $styles['primary'];
@endphp



<div x-data="{ open: false }" class="relative inline-block p-1">
    <button x-cloak @if($action) wire:click="{{$action}}@if($id)({{$id}})@endif" @endif {{$attributes->merge(['class' =>
        "px-{$px}
        py-1 rounded cursor-pointer transition duration-200 {$class}"
        ])}} @mouseenter="open = true" @mouseleave="open = false">
        <i class="{{$icon}}"></i>{{$label}}
    </button>

    <div x-show="open" x-transition x-cloak
        class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-gray-700 dark:bg-black text-white text-xs rounded px-2 py-1 whitespace-nowrap">
        {{$popup}}
    </div>
</div>