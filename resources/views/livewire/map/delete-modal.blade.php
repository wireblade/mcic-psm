<div wire:ignore.self x-data="{ open: @entangle('openDeleteModal'), focusInput(){
    $nextTick(() => this.$refs.firstInput.focus())
}}" x-cloak x-on:auto-focus.window="focusInput()" wire:keydown.enter="deleteProject"
    @keyup.escape.window="open = false">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openDeleteModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

            <h2 class="text-lg font-bold mb-3">Confirm Deletion</h2>
            <p>Are you sure you want to delete Project: <b>{{$name}}</b>?</p>
            <br>

            <div class="space-y-3">

                <div class="w-full">
                    <label for="description" class="block text-sm font-medium text-gray-300 dark:text-gray-300 mb-1">
                        Please confirm deletion code
                    </label>
                    <input type="password" wire:model="inputCode" x-ref="firstInput" placeholder="enter deletion code"
                        class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error('description') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">
                    @error('inputCode') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mt-4 flex justify-end space-x-2">

                    <x-buttons.button action="$set('openDeleteModal', false)" type="outline" label="Cancel" />

                    <x-buttons.button action="deleteProject" type="danger-outline" label="Update" />

                </div>
            </div>
        </div>
    </div>