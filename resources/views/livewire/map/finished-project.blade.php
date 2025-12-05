<div>
    @section('title', config('app.name').' |'.' '.$title)

    <div class="flex justify-between item-center mb-4">
        <h1 class="text-2xl font-bold">{{$title}}</h1>
    </div>

    <div class="overflow-x-auto rounded-lg shadow-md dark:shadow-black mt-5">
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
                    <td class="border-b border-gray-200 dark:border-gray-700 text-center">

                        <x-buttons.button-icon action="openEditModal" id="{{$project->id}}" icon="fa fa-edit"
                            label="Edit" />

                        <!-- dropdown: prevent Livewire from re-rendering this block and hide until Alpine ready -->

                        <div wire:ignore.self x-data="{ open: false }" x-cloak class="relative inline-block">
                            <x-buttons.button @click="open = !open" type="outline" px="" py="1" p="1"
                                icon="fa fa-ellipsis-v" label="More" />
                            <div x-show="open" @click.outside="open = false" x-transition
                                class="fixed right-28 mt-2 w-40 bg-white dark:border-gray-500 dark:bg-gray-800  rounded-md shadow-md shadow-black z-50 overflow-hidden ">

                                <x-buttons.drop-down-button action="openDeleteModal" icon="fa fa-trash" type="danger"
                                    :id="$project->id" label="Delete" />
                            </div>
                        </div>

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

</div>