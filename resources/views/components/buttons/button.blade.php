@props([
'type' => 'primary', // button style type
'label' => '', // button label
'id' => '', // optional id for Livewire actions
'icon' => '', // icon class
'action' => null, // Livewire action method
'px' => '3', // padding-x
'py' => '1', // padding-y
'mt' => '', // margin-top
'm' => '', // margin
'p' => '', // padding
'ml' => '', // margin-left
'popup' => '', // tooltip text
'route' => '', // route name
'page' => '', // for pagination routes
'loading' => '', // loading state label
'downloadLink' => '', // link to download file
'downloadFile' => null, // name of the file to download

])

@php

// Define styles for different button types
$styles = [
'default' => 'border-gray-400 dark:border-transparent rounded-md bg-transparent dark:bg-gray-800 text-gray-600
hover:bg-gray-300
dark:hover:bg-gray-900 dark:text-white',

'transparent' => 'border-transparent bg-transparent',

'primary' => 'rounded-md bg-blue-500 text-white hover:bg-blue-700 border-transparent',
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

// Get the appropriate class for the button type
$class = $styles[$type] ?? $styles['primary'];

// Add shadow classes conditionally
$shadowClasses = $type !== 'transparent' ? 'shadow-md dark:shadow-black' : '';

@endphp

     {{-- Wrap with anchor tag if route is provided --}}
    @if($route)
        <a href="{{ route($route, [
            'page' => $page,
        ])}}">
    @endif

    {{-- Wrap with anchor tag if downloadLink is provided --}}
    @if($downloadLink)
        <a href="{{ $downloadLink }}" 
            target="_blank"
            download="{{ $downloadFile }}
        ">
    @endif

    {{-- Popup tooltip container --}}
    @if($popup) 
        <div x-data="{ tooltip: false }" class="relative inline-block">     
    @endif

    {{-- Button element --}}
        <button x-cloak 
            @if($action)
            wire:click=" {{ $action }} @if($id) ({{$id}}) @endif"
                @if($loading)
                    wire:target="{{ $action }} @if($id) ({{$id}}) @endif"

                    @if($id)
                    wire:key="{{$id}}" 
                    x-data="{ locked: false }"
                    x-bind:disabled="locked" 
                    @click="locked = true"
                    @endif

                    wire:loading.attr="disabled"
                @endif
            @endif 
            
            {{-- Merge additional classes and styles --}}
            {{$attributes->merge(['class'=>
            "p-{$p} px-{$px} m-{$m} py-{$py} mt-{$mt} ml-{$ml} {$shadowClasses}
            transition duration-400 cursor-pointer border {$class}"])}}
        
            @if($popup)
            @mouseenter="tooltip = true"
            @mouseleave="tooltip = false"
            @endif
            >

            <i class="{{ $icon }}"> </i> 
            @if($label === 'More') 
            {{-- empty --}}
            @else

                {{-- Show loading state if applicable --}}
                @if($loading)
                    <span wire:loading.remove wire:target="{{$action}}@if($id)({{$id}})@endif">
                        {{$loading}}
                    </span>
                    <span wire:loading wire:target="{{$action}}@if($id)({{$id}})@endif">
                        <span class="fa fa-spinner animate-spin"></span> {{$loading}}ing...
                    </span>
                {{-- Else show normal label --}}
                @else
                    {{$label}} 
                @endif

            @endif       

        </button>
        
        {{-- Popup tooltip --}} 
        @if($popup) 
        <div x-show="tooltip" x-transition x-cloak
            class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-gray-700 dark:bg-black text-white text-xs rounded px-2 py-1 whitespace-nowrap">
            {{$popup}}
        </div> 
    </div>
@endif

{{-- Close anchor tag if route is provided --}}
@if($route)
    </a>
@endif

{{-- Close anchor tag if downloadLink is provided --}}
@if($downloadLink)
    </a>
@endif