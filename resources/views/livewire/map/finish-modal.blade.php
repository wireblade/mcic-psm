<div x-data="{ open: @entangle('openFinishModal') }" @keyup.escape.window="open = false">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openFinishModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

            <h2 class="text-lg font-bold mb-3">Confirm Complete</h2>
            <p>Are you sure you want to finish <b>{{$name}}</b>?</p>
            <br>

            <x-inputs.input type="date" label="Project Completed Date" name="end" autofocus="focusInput"
                placeholder="Enter deletion code" />

            <div class="mt-4 flex justify-end space-x-2">

                <x-buttons.button action="$set('openFinishModal', false)" type="outline" label="Cancel" />

                <x-buttons.button action="projectFinish" type="success-outline" label="Finish" />

            </div>
        </div>
    </div>
</div>