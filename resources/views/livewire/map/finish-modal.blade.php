<div x-data="{ open: @entangle('openFinishModal') }" @keyup.escape.window="open = false">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openFinishModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-50 translate-y-8"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-50 translate-y-8"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

            <h2 class="text-lg font-bold mb-3">Confirm Complete</h2>
            <p>Are you sure you want to finish <b>{{$name}}</b>?</p>
            <br>

            <div class="mt-1 flex justify-end space-x-2">
                <button wire:click="$set('openFinishModal', false)"
                    class="px-4 py-2 rounded-md border border-gray-500 text-gray-500 dark:border-gray-200 dark:text-gray-200  hover:bg-gray-500 hover:text-white transition duration-200">Cancel</button>

                <button wire:click="projectFinish"
                    class="px-4 py-2 rounded-md border border-green-500 text-green-500 hover:bg-green-600 hover:text-white transition duration-200">Finish</button>

            </div>
        </div>
    </div>
</div>