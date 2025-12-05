<div x-data="{ open: @entangle('openAddModal') }" @keyup.escape.window="open = false"
    x-init="$watch('open', value => { if(value) $nextTick(() => $refs.focusInput.focus()) })"
    wire:keydown.enter="saveProject">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openAddModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

            <h2 class="text-xl font-bold mb-4">Add Project</h2>
            <div class="space-y-3">

                <x-inputs.input label="Project ID" name="name" autofocus="focusInput" placeholder="Enter Project ID" />

                <x-inputs.input label="Latitude" name="latitude" placeholder="Enter Laitude" />

                <x-inputs.input label="longitude" name="longitude" placeholder="Enter longitude" />

                <x-inputs.input type="date" label="Date Start" name="dateStart" />

                <x-inputs.textarea label="Description" name="description" placeholder="Enter Description" />

            </div>

            <div class="mt-5 flex justify-end gap-3">

                <x-buttons.button action="$set('openAddModal', false)" type="outline" label="Cancel" />

                <x-buttons.button action="saveProject" type="outline" label="Add Project" />

            </div>
        </div>
    </div>

</div>