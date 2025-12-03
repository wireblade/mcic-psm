@props([
'type' => 'primary',
'label' => '',
'id' => '',
'icon' => '',
'action' => null,
'px' => '3',
'py' => '1',
'mt' => '',
'm' => '',
])

@php
$styles = [
'default' => 'bg-gray-500 dark:bg-gray-800 text-white hover:bg-gray-700 dark:hover:bg-gray-900',
'primary' => 'bg-blue-500 text-white hover:bg-blue-700',
'danger' => 'bg-red-500 text-white hover:bg-red-700',
'success' => 'bg-green-500 text-white hover:bg-green-700',

'outline' => 'border border-gray-600 text-gray-700 hover:bg-gray-200 dark:bg-gray- dark:border-gray-
dark:text-gray-600
dark:hover:bg-gray-900 dark:hover:border-gray-900 dark:text-white',

'danger-outline' => 'border border-red-700 text-red-500 hover:bg-red-700 hover:text-white',

'primary-outline' => 'border border-blue-700 text-blue-500 hover:bg-blue-700 hover:text-white',

'success-outline' => 'border border-green-700 text-green-500 hover:bg-green-700 hover:text-white',
];

$class = $styles[$type] ?? $styles['primary'];
@endphp

<button @if($action) wire:click="{{ $action }} @if($id)({{$id}})@endif" @endif
    class="px-{{$px}} m-{{$m}} py-{{$py}} mt-{{$mt}} rounded-md shadow-gray-400 dark:shadow-black shadow-sm transition duration-200 {{ $class }}">
    <i class="{{ $icon }}"></i> {{ $label }}
</button>