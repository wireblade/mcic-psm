<div wire:ignore.self x-data="{ open: @entangle('openChangeModal') }" x-cloak
    x-init="$watch('open', value => { if(value) $nextTick(() => $refs.focusInput.focus()) })"
    wire:keydown.enter="changeCode" @keyup.escape.window="open = false">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openChangeModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

            <h2 class="text-lg font-bold mb-3">Confirm Deletion</h2>
            <p>Update deletion code: </p>
            <br>

            <div class="space-y-3">

                <x-inputs.input type="password" label="Current Code" name="confirmCurrentCode" autofocus="focusInput"
                    placeholder="Enter current code" />

                <x-inputs.input type="password" label="New code" name="new" placeholder="Enter new code" />

                <x-inputs.input type="password" label="Confirm new code" name="new_confirmation"
                    placeholder="Confirm new code" />

                <div class="mt-4 flex justify-end space-x-2">

                    <x-buttons.button action="$set('openChangeModal', false)" type="outline" label="Cancel" />

                    <x-buttons.button action="changeCode" type="primary-outline" label="Update" />

                </div>

            </div>

        </div>
    </div>
</div>