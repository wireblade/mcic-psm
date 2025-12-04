<section class="w-full">
    @include('partials.settings-heading')

    @if($count > 0)

    <x-settings.layout :heading="__('Code Registered')" :subheading=" __('Update or remove deletion code')">
        <div class="mt-2">
            <x-buttons.button action="" type="primary-outline" label="Change" />

            <x-buttons.button m="1" type="danger-outline" action="openRemoveModal" id="{{$id->id}}" label="Remove" />
        </div>
    </x-settings.layout>

    @else

    <x-settings.layout :heading="__('Deletion Code')" :subheading=" __('Register a deletion code for project removal')">
        <div wire:keydown.enter="saveCode" x-data x-init="$refs.firstInput.focus()">

            <x-inputs.input type="password" mb="2" autofocus label="Enter Deletion Code" name="code"
                autofocus="firstInput" />

            <x-inputs.input type="password" mb="2" label="Confirm Deletion Code" name="code_confirmation" />

            <x-buttons.button action="saveCode" px="5" py="2" label="Save" />
        </div>
    </x-settings.layout>

    @endif

    <livewire:settings.remove-code-modal />

</section>