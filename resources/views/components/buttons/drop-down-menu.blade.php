@props([
'deleteId' => '',
'finishId' => '',
'fileId' => '',
])


<div wire:ignore.self x-data="{ open: false, pos: { top: 0, left: 0 } }" x-cloak class="inline-block">

    <!-- BUTTON -->
    <x-buttons.button @click="
    const r = $el.getBoundingClientRect();
    pos.top = r.bottom + window.scrollY + 6;
    pos.left = r.left + window.scrollX - 145;
    open = !open;" type="menu" px="" py="1" p="1" icon="fa fa-ellipsis-v" popup="More" />

    <!-- DROPDOWN TELEPORTED OUTSIDE TABLE -->
    <template x-teleport="body">
        <div x-show="open" @click.outside="open = false" x-transition
            class="w-40 bg-white absolute mr-30 dark:border-gray-500 dark:bg-gray-800 rounded-md shadow-md shadow-black z-50 overflow-hidden"
            :style="`top: ${pos.top}px; left: ${pos.left}px;`">


            <x-buttons.drop-down-button route="project.files" icon="fa fa-circle-check" type="default" :id="$fileId"
                label="View files" />

            <div class="bg-gray-200 p-0.5 dark:bg-gray-700"></div>

            @if($finishId)

            <x-buttons.drop-down-button action="openFinishModal" icon="fa fa-circle-check" type="success"
                :id="$finishId" label="Finish" />


            @endif

            <div class="bg-gray-200 p-0.5 dark:bg-gray-700"></div>

            <x-buttons.drop-down-button action="openDeleteModal" icon="fa fa-trash" type="danger" :id="$deleteId"
                label="Delete" />
        </div>
    </template>

</div>