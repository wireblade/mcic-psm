@props([
'type' => 'primary',
'click' => 'null',
'label' => '',
'id' => '',
'icon' => '',
'action' => null,
'px' => '3',
'py' => '1',
'mt' => '',
'm' => '',
'p' => '',
'ml' => '',
'popup' => '',
])

@php
$styles = [
'default' => 'border-transparent rounded-md bg-gray-500 dark:bg-gray-800 text-white hover:bg-gray-700
dark:hover:bg-gray-900',
'primary' => 'rounded-md bg-blue-500 text-white hover:bg-blue-700',
'danger' => 'rounded-md bg-red-500 text-white hover:bg-red-700',
'success' => 'rounded-md bg-green-500 text-white hover:bg-green-700',
'empty' => 'border-transparent bg-transparent shadow-transparent',

'outline' => 'rounded-md border border-gray-600 text-gray-700 hover:bg-gray-200 dark:bg-gray-800
dark:text-gray-600
dark:hover:bg-gray-900 dark:hover:border-gray-900 dark:text-white',

'menu' => 'rounded-sm border border-gray-400 text-gray-600 hover:border-gray-600 hover:bg-gray-600 dark:bg-gray-800
dark:border-gray-600
dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:border-gray-500 hover:text-white',

'danger-outline' => 'rounded-md border border-red-700 text-red-500 hover:bg-red-700 hover:text-white',

'primary-outline' => 'rounded-md border border-blue-700 text-blue-500 hover:bg-blue-700 hover:text-white',

'success-outline' => 'rounded-md border border-green-700 text-green-500 hover:bg-green-700 hover:text-white',
];

$class = $styles[$type] ?? $styles['primary'];
@endphp


@if($popup) <div x-data="{ tooltip: false }" class="relative inline-block"> @endif

    <button @if($action) wire:click="{{ $action }} @if($id)({{$id}})@endif" @endif {{$attributes->merge(['class'=>
        "p-{$p} px-{$px} m-{$m} py-{$py} mt-{$mt} ml-{$ml} dark:shadow-black shadow-md
        transition duration-400 cursor-pointer border {$class}"])}} @mouseenter="tooltip = true" @mouseleave="tooltip =
        false">
        <i class="{{ $icon }}"></i> @if($label === 'More') @else {{$label}} @endif
    </button>

    @if($popup) <div x-show="tooltip" x-transition x-cloak
        class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-gray-700 dark:bg-black text-white text-xs rounded px-2 py-1 whitespace-nowrap">
        {{$popup}}
    </div>
</div>

@endif