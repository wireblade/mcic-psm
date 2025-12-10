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
                        <x-buttons.button action="viewDescription" id="{{$project->id}}" popup="View Description" px="1"
                            type="empty" label="🔍" />
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

                        <x-buttons.button-icon type="default" action="openEditModal" id="{{$project->id}}"
                            icon="fa fa-edit" label="Edit" />

                        <!-- dropdown: prevent Livewire from re-rendering this block and hide until Alpine ready -->

                        <div wire:ignore.self x-data="{ open: false, pos: { top: 0, left: 0 } }" x-cloak
                            class="inline-block">

                            <!-- BUTTON -->
                            <x-buttons.button @click="
                                const r = $el.getBoundingClientRect();
                                pos.top = r.bottom + window.scrollY + 6;
                                pos.left = r.left + window.scrollX - 145;
                                open = !open;" type="menu" px="" py="1" p="1" icon="fa fa-ellipsis-v" label="More" />

                            <!-- DROPDOWN TELEPORTED OUTSIDE TABLE -->
                            <template x-teleport="body">
                                <div x-show="open" @click.outside="open = false" x-transition
                                    class="w-40 bg-white absolute mr-30 dark:border-gray-500 dark:bg-gray-800 rounded-md shadow-md shadow-black z-50 overflow-hidden"
                                    :style="`top: ${pos.top}px; left: ${pos.left}px;`">

                                    <div class="bg-gray-200 p-0.5 dark:bg-gray-700"></div>

                                    <x-buttons.drop-down-button action="openDeleteModal" icon="fa fa-trash"
                                        type="danger" :id="$project->id" label="Delete" />
                                </div>
                            </template>

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

    <livewire:map.view-description />
    <livewire:map.edit-modal />
    <livewire:map.delete-modal />

</div>