@section('title', config('app.name').' |'.' '.$name)

<div>
    <div>
        <a href="{{ route( $status > 0 ? 'map.finished' :  'map.index', ['page' => $page]) }}"
            class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
            ← Back to List
        </a>

        {{--
        <x-buttons.button type="transparent" route="{{$status > 0 ? 'map.finished' : 'map.index'}}" :page="$page"
            label="← Back to List" /> --}}

    </div>

    <div class="flex justify-between item-center">
        <h1 class="text-2xl font-bold"> {{$name}}</h1>
    </div>

    <small>{{$description}}</small>

    <div class="flex justify-between items-center mt-3 mb-3">
        <!-- Left: Title and Add button -->
        <div class="flex items-center space-x-2">
            <x-buttons.button action="openUploadModal" id="{{$id}}" type="default" label="Upload Files"
                icon="fa fa-file fa-xs" />
        </div>
    </div>

    @php
    $groupedByCategory = $project->files->groupBy('category');
    @endphp

    @foreach ($groupedByCategory as $category => $filesInCategory)
    <div class="mt-8">
        <h1
            class="uppercase text-2xl font-bold border-b dark:border-gray-400 pb-1 mb-4 text-gray-800 dark:text-gray-300">
            {{
            $category }}</h1>

        @php
        $groupedByDate = $filesInCategory
        ->sortByDesc('created_at')
        ->groupBy(function ($file) {
        return $file->created_at->format('Y-m-d');
        });
        @endphp

        @foreach ($groupedByDate as $date => $files)
        <div class="mb-6">
            <small class="dark:text-gray-300 text-gray-600 mb-2">
                {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
            </small>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($files as $file)
                <div
                    class="flex items-center justify-between bg-white dark:bg-gray-200 shadow-sm rounded-lg p-3 border hover:shadow-md transition">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-700 truncate">{{ $file->original_name }}</p>
                        <p class="text-xs text-gray-400">
                            {{ number_format($file->file_size / 1048576, 2) }} MB
                        </p>
                    </div>

                    @if($file->mime_type == 'video/mp4')

                    <a href="{{ Storage::url($file->file_path) }}" target="_blank"
                        class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                        🟢
                    </a>

                    @endif

                    <a href="{{ Storage::url($file->file_path) }}" target="_blank"
                        download="{{ basename($file->file_path) }}"
                        class="ml-2 text-blue-600 hover:text-blue-800 font-semibold text-sm">
                        ⬇️
                    </a>

                    <x-buttons.button type="transparent" px="" label="⛔" action="openDeleteFileModal"
                        id="{{$file->id}}" />

                </div>
                @endforeach
            </div>

        </div>
        @endforeach
    </div>
    @endforeach
</div>