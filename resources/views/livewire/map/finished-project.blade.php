<div>
    @section('title', config('app.name').' |'.' '.$title)

    <div class="flex justify-between item-center mb-4">
        <h1 class="text-2xl font-bold">{{$title}}</h1>
    </div>

    <x-inputs.search placeholder="Search Projects" live="search" />

    <div class="overflow-x-auto rounded-lg shadow-md dark:shadow-black mt-5">
        <table class="min-w-full text-sm text-left bg-white dark:bg-gray-800 ">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">No</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Project ID</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Latitude</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Longitude</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Description</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Start Date</th>
                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Finish Date</th>
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
                    <td class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">
                        @if(!empty($project->description))
                        {{ Str::limit($project->description, 50) }}
                        @if(Str::length($project->description) > 50)
                        <x-buttons.button action="viewDescription" id="{{$project->id}}" popup="View Description" px="0"
                            type="transparent" label="🔍" />
                        @endif
                        @endif
                    </td>
                    <td class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">
                        {{ optional($project->dateStart)?->format('M d Y') ?? '' }}
                    </td>
                    <td class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">
                        {{ optional($project->dateEnd)?->format('M d Y') ?? '' }}
                    </td>
                    <td class="border-b border-gray-200 dark:border-gray-700 text-center">

                        <x-buttons.button type="menu" action="openEditModal" id="{{$project->id}}" icon="fa fa-edit"
                            px="2" popup="Edit" />

                        <!-- dropdown: prevent Livewire from re-rendering this block and hide until Alpine ready -->
                        <x-buttons.drop-down-menu projId="{{$project->id}}" page="{{$projects->currentPage()}}" />

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
        {{ $projects->links(data: ['scrollTo' => false]) }}
    </div>



</div>