<section>
    @section('title', config('app.name').' |'.' '.$title)

    <section>

        @if(session('success'))
        <x-alert type="success" message="{{ session('success') }}" timeout="5000">
        </x-alert>
        @endif

        @if(session('error'))
        <x-alert type="error" message="{{session('error')}}" timeout="5000">
        </x-alert>
        @endif

        <div class="flex justify-between item-center mb-4">
            <h1 class="text-2xl font-bold">{{$title}}</h1>
        </div>

        <div class="overflow-x-auto rounded-lg shadow-md mt-5">
            <table class="min-w-full text-sm text-left bg-white dark:bg-gray-800 ">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">No</th>
                        <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Project Name</th>
                        <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Latitude</th>
                        <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Longitude</th>
                        <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Description</th>
                        <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600 text-center ">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 dark:text-gray-200">
                    @forelse($projects as $project)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                        <td class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">{{$projects->firstItem() +
                            $loop->index}}</td>
                        <td class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">{{$project->name}}</td>
                        <td class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">{{$project->latitude}}</td>
                        <td class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">{{$project->longitude}}</td>
                        <td class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">{{$project->description}}
                        </td>
                        <td class="border-b border-gray-200 dark:border-gray-700">
                            <center>
                                <div wire:click="openEditModal({{$project->id}})" x-data="{ open: false }"
                                    class="relative inline-block p-1">
                                    <button @mouseenter="open = true" @mouseleave="open = false"
                                        class="px-2 py-1 rounded text-blue-500 border border-blue-500 hover:bg-blue-700 hover:text-white transition duration-200">
                                        <i class="fa fa-edit justify-center" title="Edit"></i>
                                    </button>

                                    <div x-show="open" x-transition
                                        class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded px-2 py-1">
                                        Edit
                                    </div>
                                </div>


                                <div x-data="{ open: false }" class="relative inline-block p-1">
                                    <button wire:click="openDeleteModal({{$project->id}})" @mouseenter="open = true"
                                        @mouseleave="open = false"
                                        class="px-2 py-1 rounded text-red-500 border border-red-500 hover:bg-red-700 hover:text-white transition duration-200"
                                        title="Trash">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <div x-show="open" x-transition
                                        class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded px-2 py-1">
                                        Delete
                                    </div>
                                </div>
                            </center>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-center">No
                            records found.</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $projects->links() }}
        </div>

        <livewire:map.edit-modal />

        <livewire:map.delete-modal />


    </section>
</section>