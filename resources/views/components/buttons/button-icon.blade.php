@props([
'type' => 'primary',
'click' => 'null',
'label' => '',
'id' => '',
'icon' => '',
'action' => null,
])

@php
$styles = [
'default' => 'rounded-md border-gray-500 text-gray-500 hover:bg-gray-700 hover:text-white',
'primary' => 'rounded-md border-blue-500 text-blue-500 hover:bg-blue-700 hover:text-white',
'danger' => 'rounded-md bg-red-500 text-white hover:bg-red-700',
'success' => 'rounded-md bg-green-500 text-white hover:bg-green-700',
];

$class = $styles[$type] ?? $styles['primary'];
@endphp



<div x-data="{ open: false }" class="relative inline-block p-1">
    <button @if($action) wire:click="{{$action}}@if($id)({{$id}})@endif" @endif {{$attributes->merge(['class' => "px-2
        py-1 rounded border shadow-sm shadow-gray-400 cursor-pointer dark:shadow-black transition duration-200 {$class}"
        ])}} @mouseenter="open = true" @mouseleave="open = false">
        <i class="{{$icon}}"></i>
    </button>

    <div x-show="open" x-transition x-cloak
        class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded px-2 py-1">
        {{$label}}
    </div>
</div>