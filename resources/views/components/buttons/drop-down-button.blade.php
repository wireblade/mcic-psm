@props([
'type' => 'primary',
'route' => '',
'action' => '',
'id',
'label',
'icon' => '',
'page' => null,
])

@php
$styles = [
'primary' => 'hover:bg-gray-100 border border-transparent',
'success' => 'hover:bg-gray-100 border border-transparent text-green-600 dark:text-green-300 hover:text-white
hover:bg-green-700',
'danger' => 'hover:bg-gray-100 border border-transparent text-red-600 dark:text-red-300 hover:text-white
hover:bg-red-700',
'default' => 'hover:bg-gray-500 hover:text-white text-black dark:text-gray-300 border border-transparent
dark:hover:bg-gray-600',

];

$class = $styles[$type] ?? $styles['primary'];

@endphp

{{-- <a href="{{ route('project.files', ['id' => $project->id, 'page' => $projects->currentPage()]) }}"
    class="btn btn-primary">
    View File
</a> --}}

<div>
    @if($route)<a href="{{ route($route,[
        'id' => $id,
        'page' => $page,
        ])}} "> @endif
        <button @if($action) x-on:click=" open=false; $wire.{{$action}}({{ $id }}); " @endif
            wire:click=" @if($action){{$action}}@endif @if($id)({{ $id }})@endif"
            class="w-full text-left px-3 py-2 transition duration-400  {{$class}}">
            <i class="{{$icon}}  hover:text-white text-xs mr-1"></i> {{$label}}
        </button>
        @if($route) </a> @endif
</div>


{{-- <div>
    @if($route)<a href="{{ route($route, $id)}} "> @endif
        <button @if($action) x-on:click="open = false; $wire.{{$action}}({{ $id }}); " @endif
            wire:click="@if($action){{$action}}@endif @if($id)({{ $id }})@endif"
            class="w-full text-left px-3 py-2 transition duration-400  {{$class}}">
            <i class="{{$icon}}  hover:text-white text-xs mr-1"></i> {{$label}}
        </button>
        @if($route) </a> @endif
</div> --}}