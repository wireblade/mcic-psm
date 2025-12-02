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

    <x-buttons.button action="openAddModal" type="default" label="Add Project" icon="fa fa-plus-circle" />

    <div class="overflow-x-auto rounded-lg shadow-md mt-5 dark:shadow-black">
        <table class="min-w-full text-sm text-left bg-white dark:bg-gray-800 ">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">No</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Project ID</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Latitude</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Longitude</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Description</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600 text-center">Actions
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
                        <x-buttons.button-icon action="openFinishModal" id="{{$project->id}}" icon="fa fa-circle-check"
                            label="Finish" color="green" />
                        <x-buttons.button-icon action="openDeleteModal" id="{{$project->id}}" icon="fa fa-trash"
                            color="red" label="Delete" />
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">
                        <center>
                            No departments found.
                        </center>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>

    <livewire:map.edit-modal />

    <livewire:map.add-modal />

    <livewire:map.finish-modal />

    <livewire:map.delete-modal />


</section>