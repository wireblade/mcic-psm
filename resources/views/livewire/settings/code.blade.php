<section class="w-full">
    @include('partials.settings-heading')

    @if($count > 0)

    <x-settings.layout :heading="__('Code Registered')" :subheading=" __('Update or remove deletion code')">
        <div class="mt-2">
            <button wire:click=""
                class="px-3 py-1 rounded-md shadow-md bg-blue-500 text-white hover:bg-blue-700 transition duration-200">
                Change
            </button>

            <x-buttons.button m="1" type="danger" action="openRemoveModal" id="{{$id->id}}" label="Remove" />
        </div>
    </x-settings.layout>

    @else

    <x-settings.layout :heading="__('Deletion Code')" :subheading=" __('Register a deletion code for project removal')">

        <x-inputs.input type="password" mb="2" label="Enter Deletion Code" name="code" />

        <x-inputs.input type="password" mb="2" label="Confirm Deletion Code" name="code_confirmation" />

        <x-buttons.button action="saveCode" px="5" py="2" label="Save" />

    </x-settings.layout>

    @endif

    <livewire:settings.remove-code-modal />

</section>