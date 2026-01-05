<div wire:ignore.self x-data="{ open: @entangle('openDeleteFileModal') }" x-cloak wire:keydown.enter="deleteFile"
    @keyup.escape.window="open = false">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openDeleteFileModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

            <h2 class="text-lg font-bold mb-3">Confirm Deletion</h2>
            <p>Are you sure you want to delete Project: </p>
            <br>

            <div class="space-y-3">
                <div class="mt-4 flex justify-end space-x-2">

                    <x-buttons.button action="$set('openDeleteModal', false)" type="outline" label="Cancel" />


                    <x-buttons.button key="deleteFile" keyId="{{ $fileId }}" type="danger-outline" />

                    {{-- <button wire:key="{{ $fileId }}" x-data="{ locked: false }" x-bind:disabled="locked"
                        @click="locked = true" wire:click="deleteFile({{ $fileId }})"
                        wire:target="deleteFile({{ $fileId }})" wire:loading.attr="disabled" class="btn btn-danger">


                        <span wire:loading.remove wire:target="deleteFile({{ $fileId }})">
                            Delete
                        </span>

                        <span wire:loading wire:target="deleteFile({{ $fileId }})">
                            <span class="fa fa-spinner animate-spin"></span> Deleting
                        </span>

                    </button> --}}



                </div>

            </div>

        </div>
    </div>
</div>