@props([
'live' => '',
'placeholder' => '',
'type'=> 'text',
'autofocus' => '',
])

<div class="flex justify-end">
    <div class="w-72">
        <input type="{{$type}}" @if($live) wire:model.live="{{$live}}" @endif placeholder="{{$placeholder}}"
            class="w-full px-4 py-1.5 border dark:border-transparent text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 rounded-md shadow-sm dark:shadow-black focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">
    </div>
</div>