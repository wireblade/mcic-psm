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
            <div class="fakefiller-allow">
                <div class="space-y-3">

                    <x-inputs.input label="Project ID" name="name" autofocus="focusInput"
                        placeholder="Enter Project ID" />

                    <x-inputs.input label="Latitude" name="latitude" placeholder="Enter Laitude" />

                    <x-inputs.input label="Lingitude" name="longitude" placeholder="Enter Laitude" />

                    <div class="w-full">
                        <label for="longitude" class="block text-sm font-medium text-gray-300 dark:text-gray-300 mb-1">
                            Longitude
                        </label>
                        <input type="text" wire:model="longitude" placeholder="Enter Longitude"
                            class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error('longitude') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">
                        @error('longitude') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="w-full">
                        <label for="dateStart" class="block text-sm font-medium text-gray-300 dark:text-gray-300 mb-1">
                            Date Start
                        </label>
                        <input type="date" wire:model="dateStart"
                            class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error('dateStart') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">
                        @error('dateStart') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>


                    <div class="w-full">
                        <label for="description"
                            class="block text-sm font-medium text-gray-300 dark:text-gray-300 mb-1">
                            Description
                        </label>
                        <textarea type="text" wire:model="description"
                            class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error('description') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">Enter Description</textarea>
                        @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                </div>
            </div>

            <div class="mt-5 flex justify-end gap-3">

                <x-buttons.button action="$set('openAddModal', false)" type="outline" label="Cancel" />

                <x-buttons.button action="saveProject" type="outline" label="Add Project" />

            </div>
        </div>
    </div>

</div>