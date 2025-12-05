<div x-data="{ open: @entangle('openEditModal') }" x-cloak @keyup.escape.window="open = false"
    x-init="$watch('open', value => { if(value) $nextTick(() => $refs.focusInput.focus()) })"
    wire:keydown.enter="updateProject()">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openEditModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

            <h2 class="text-xl font-bold mb-4">Update Project</h2>
            <div class="space-y-3">

                <x-inputs.input label="Project Name" name="name" autofocus="focusInput" />

                <x-inputs.input label="Latitude" name="latitude" />

                <x-inputs.input label="Longitude" name="longitude" />

                @if($status === 0)

                <x-inputs.input label="Date Start" name="dateStart" type="date" />

                @else

                @if(!empty($dateStartIfEmpty))

                <x-inputs.input label="Date Start" name="dateStart" type="date" />

                <x-inputs.input label="Date End" name="dateEnd" type="date" />

                @else

                <x-inputs.input label="Date Start" name="dateStart" type="date" />

                @endif

                @endif

                <x-inputs.textarea label="Description" name="description" />

            </div>

            <div class="mt-5 flex justify-end gap-3">

                <x-buttons.button action="$set('openEditModal', false)" type="outline" label="Cancel" />

                <x-buttons.button action="updateProject" type="primary-outline" label="Update" />

            </div>
        </div>
    </div>

</div>