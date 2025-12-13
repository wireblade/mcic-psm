@section('title', config('app.name').' |'.' '.$title)

<div>

    <div class="flex justify-between item-center mb-4">
        <h1 class="text-2xl font-bold">{{$title}}</h1>
    </div>

    <div class="flex justify-between items-center mb-4">
        <!-- Left: Title and Add button -->
        <div class="flex items-center space-x-2">
            <x-buttons.button action="openAddModal" type="default" label="Add Project" icon="fa fa-plus-circle" />
        </div>

        <!-- Right: Search input -->
        <div class="w-72">
            <x-inputs.search placeholder="Search Projects" live="search" />
        </div>


    </div>

    <div class="overflow-x-auto rounded-lg shadow-md mt-5 dark:shadow-black">
        <table class="min-w-full text-sm text-left bg-white dark:bg-gray-800 ">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">No</th>
                    <th class="w-1/6 px-6 py-3 border-b border-gray-300 dark:border-gray-600">Project ID</th>
                    <th class="w-1/6 px-6 py-3 border-b border-gray-300 dark:border-gray-600">Latitude</th>
                    <th class="w-1/6 px-6 py-3 border-b border-gray-300 dark:border-gray-600">Longitude</th>
                    <th class="w-1/3 px-6 py-3 border-b border-gray-300 dark:border-gray-600">Description</th>
                    <th class="w-1/6 px-6 py-3 border-b border-gray-300 dark:border-gray-600">Date Start</th>
                    <th class="w-1/6 px-6 py-3 border-b border-gray-300 dark:border-gray-600 text-center">Actions
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
                    <td class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">
                        @if(!empty($project->description))
                        {{ Str::limit($project->description, 50) }}
                        @if(Str::length($project->description) > 50)
                        <x-buttons.button-icon action="viewDescription" id="{{$project->id}}" popup="View Description"
                            px="0" type="menu" label="🔍" />
                        @endif
                        @endif
                    </td>

                    <td class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">
                        {{ optional($project->dateStart)?->format('M d Y') ?? '' }}
                    </td>

                    <td class="border-b border-gray-200 dark:border-gray-700 text-center">

                        <x-buttons.button type="menu" action="openEditModal" id="{{$project->id}}" icon="fa fa-edit"
                            px="2" popup="Edit" />

                        <!-- dropdown: prevent Livewire from re-rendering this block and hide until Alpine ready -->
                        <x-buttons.drop-down-menu finishId="{{$project->id}}" deleteId="{{$project->id}}" />

                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">
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
        {{ $projects->links(data: ['scrollTo' => false]) }}
    </div>

</div>