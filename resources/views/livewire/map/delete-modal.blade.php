<div x-data="{ open: @entangle('openDeleteModal') }" @keyup.escape.window="open = false">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openDeleteModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-50 translate-y-8"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-50 translate-y-8"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

            <h2 class="text-lg font-bold mb-3">Confirm Deletion</h2>
            <p>Are you sure you want to delete Project: <b>{{$name}}</b>?</p>
            <br>

            <div class="space-y-3">

                <div class="w-full">
                    <label for="description" class="block text-sm font-medium text-gray-300 dark:text-gray-300 mb-1">
                        Please confirm deletion code
                    </label>
                    <input type="password" wire:model="inputCode" placeholder="enter deletion code"
                        class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error('description') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">
                    @error('inputCode') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mt-4 flex justify-end space-x-2">
                    <button wire:click="$set('openDeleteModal', false)"
                        class="px-4 py-2 rounded-md border border-gray-500 text-gray-500 dark:border-gray-200 dark:text-gray-200 hover:bg-gray-500 hover:text-white transition duration-200">Cancel</button>

                    <button wire:click="deleteProject"
                        class="px-4 py-2 rounded-md border border-red-500 text-red-500 hover:bg-red-600 hover:text-white transition duration-200">Delete</button>

                </div>
            </div>
        </div>
    </div>