@props([
'label',
'name' => '',
'placeholder' => '',
'type'=> 'text',
'autofocus' => '',
'mb' => '',
])

<div class="w-full mb-{{$mb}}">
    <label for="{{$name}}" class="block text-sm font-medium text-gray-300 dark:text-gray-300 mb-1">
        {{$label}}
    </label>
    <input type="{{$type}}" @if($name) x-ref="{{$autofocus}}" wire:model="{{$name}}" @endif
        placeholder="{{$placeholder}}"
        class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error($name) border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">
    @error($name) <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>