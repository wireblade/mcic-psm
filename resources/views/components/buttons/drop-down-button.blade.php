@props([
'type' => 'primary',
'action',
'id',
'label',
'icon' => '',
])

@php
$styles = [
'primary' => 'hover:bg-gray-100 border border-transparent',
'success' => 'hover:bg-gray-100 border border-transparent text-green-600 dark:text-green-300 hover:text-white
hover:bg-green-700',
'danger' => 'hover:bg-gray-100 border border-transparent text-red-600 dark:text-red-300 hover:text-white
hover:bg-red-700',

];

$class = $styles[$type] ?? $styles['primary'];

@endphp

<div>
    <button wire:click="@if($action){{$action}}@endif @if($id)({{ $id }})@endif"
        class="w-full text-left px-3 py-2 transition duration-400  {{$class}}">
        <i class="{{$icon}}  hover:text-white text-xs mr-1"></i> {{$label}}
    </button>
</div>