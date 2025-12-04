<div>
    <div x-data="{ open: @entangle('openRemoveModal') }" @keyup.escape.window="open = false"
        x-init="$watch('open', value => { if(value) $nextTick(() => $refs.focusInput.focus()) })"
        wire:keydown.enter="removeCode">

        <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

            <div @click.outside="$wire.set('openRemoveModal', false)" x-show="open"
                x-transition:enter="transition ease-out duration-200 transform"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150 transform"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

                <h2 class="text-lg font-bold mb-3">Confirm Remove</h2>

                <div class="space-y-3">

                    <x-inputs.input label="Please confirm deletion code" autofocus="focusInput" name="confirm" />

                    <div class="mt-4 flex justify-end space-x-2">

                        <x-buttons.button type="outline" action="$set('openRemoveModal', false)" label="Cancel" />

                        <x-buttons.button type="danger-outline" label="Remove" action="removeCode()" />

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>