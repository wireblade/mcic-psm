<section class="w-full">
    @include('partials.settings-heading')

    @if(session('success'))
    <x-alert type="success" message="{{ session('success') }}" timeout="5000">
    </x-alert>
    @endif

    @if(session('error'))
    <x-alert type="error" message="{{session('error')}}" timeout="5000">
    </x-alert>
    @endif

    @if($count > 0)

    <x-settings.layout :heading="__('Deletion Code')" :subheading=" __('Please register deletion code')">
        <div class="mt-2">
            <button wire:click=""
                class="px-3 py-1 rounded-md shadow-md bg-blue-500 text-white hover:bg-blue-700 transition duration-200">
                Change
            </button>

            <button wire:click="openRemoveModal({{$id->id}})"
                class="m-1 px-3 py-1 rounded-md shadow-md bg-red-500 text-white hover:bg-red-700 transition duration-200">
                Remove
            </button>
        </div>
    </x-settings.layout>

    @else

    <x-settings.layout :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">

        <div class="w-full">
            <label for="code" class="block text-sm font-medium text-gray-400 dark:text-gray-300 mb-1">
                Enter Deletion code
            </label>
            <input type="password" x-ref="input" wire:model="code"
                class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error('code') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">
            @error('code') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="w-full mt-4 mb-2">
            <label for="code_confirmation" class="block text-sm font-medium text-gray-400 dark:text-gray-300 mb-1">
                Confirm Deletion code
            </label>
            <input type="password" x-ref="input" wire:model="code_confirmation"
                class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error('code_confirmation') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">

        </div>

        <div>
            <button wire:click="saveCode"
                class=" px-5 py-2 mt-2 rounded-md bg-blue-500 text-white shadow-md  hover:bg-blue-700 hover:text-white transition duration-200">
                Save</button>
        </div>

    </x-settings.layout>

    @endif

    <livewire:settings.remove-code-modal />

</section>