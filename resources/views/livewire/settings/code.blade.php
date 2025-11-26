<section class="w-full">
    @include('partials.settings-heading')

    @if(session('success'))
    <x-alert type="success" message="{{ session('success') }}" timeout="5000">
    </x-alert>
    @endif

    @if(session('error'))
    <x-alert type="error" message="{{session('error')}}" timeout="5000">
    </x-alert>
    @endif

    <x-settings.layout>


        @if($count > 0)

        <h1>Code is Registered</h1>
        <div class="mt-2">
            <button wire:click=""
                class="m-1 px-3 py-1 rounded-md shadow-md bg-blue-500 text-white hover:bg-blue-700 transition duration-200">
                Change
            </button>

            <button wire:click="removeCode({{$id->id}})"
                class="m-1 px-3 py-1 rounded-md shadow-md bg-red-500 text-white hover:bg-red-700 transition duration-200">
                Remove
            </button>
        </div>

        @else

        <div>
            <label for="">Delection Code</label>
            <input wire:model="code" type="password" class="w-full border rounded p-2 border-gray-500"
                placeholder="enter deletion code.">
        </div>

        <div>
            <button wire:click="saveCode"
                class=" px-5 py-2 mt-2 rounded-md bg-blue-500 text-white  hover:bg-blue-700 hover:text-white transition duration-200">
                Save</button>
        </div>

        @endif

    </x-settings.layout>

    <div>
        <div x-data="{ open: @entangle('openRemoveCode') }" x-cloak @keyup.escape.window="open = false">

            <div x-show="open" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-400" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

                <div @click.outside="$wire.set('openRemoveCode', false)" x-show="open"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 scale-50 translate-y-8"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-50 translate-y-8"
                    class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

                    <h2 class="text-xl font-bold mb-4">Add Department</h2>
                    <div class="fakefiller-allow">
                        <div class="space-y-3">

                            <div class="w-full">
                                <label for="name"
                                    class="block text-sm font-medium text-gray-300 dark:text-gray-300 mb-1">
                                    Project Name
                                </label>
                                <input type="text" wire:model="name" placeholder="Enter Project ID"
                                    class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error('name') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">
                                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>

                            <div class="w-full">
                                <label for="latitude"
                                    class="block text-sm font-medium text-gray-300 dark:text-gray-300 mb-1">
                                    Latitude
                                </label>
                                <input type="text" wire:model="latitude" placeholder="Enter Latitude"
                                    class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error('latitude') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">
                                @error('latitude') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>



                            <div class="w-full">
                                <label for="longitude"
                                    class="block text-sm font-medium text-gray-300 dark:text-gray-300 mb-1">
                                    Longitude
                                </label>
                                <input type="text" wire:model="longitude" placeholder="Enter Longitude"
                                    class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 @error('longitude') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400 dark:placeholder-gray-500 transition">
                                @error('longitude') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
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

                        <button wire:click="$set('openRemoveCode', false)"
                            class="px-3 py-2 rounded border border-gray-500 text-grey-500 hover:bg-gray-500 hover:text-white transition duration-200">Cancel</button>

                        <button wire:click="saveProject"
                            class="px-3 py-2 rounded text-blue-500 border border-blue-500 hover:bg-blue-500 hover:text-white transition duration-200">Add
                            Project</button>

                    </div>
                </div>
            </div>

        </div>
    </div>

</section>