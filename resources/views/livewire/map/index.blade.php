@section('title', config('app.name').' |'.' '.$title)

<section>

    <a href="{{@route('map.view')}}">
        <button class="px-2 py-2 rounded text-white bg-blue-500 hover:bg-blue-700">View Map</button>
    </a>

    <table class="min-w-full border border-gray-300 mt-5">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Project Name</th>
                <th class="border px-4 py-2">Latitude</th>
                <th class="border px-4 py-2 w-28">longitude</th>
                <th class="border px-4 py-2 w-28">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td class="border px-4 py-2">{{ $projects->firstItem() + $loop->index }}</td>
                <td class="border px-4 py-2">{{ $project->name }}</td>
                <td class="border px-4 py-2">{{ $project->latitude }}</td>
                <td class="border px-4 py-2">{{ $project->longitude }}</td>
                <td class="border px-4 py-2">
                    <center>
                        <button
                            class="px-2 py-1 rounded text-blue-500 bg-transparent hover:bg-blue-700 hover:text-white transition duration-200">
                            <i class="fa fa-edit justify-center"></i>
                        </button> | <button
                            class="px-2 py-1 rounded text-red-500 bg-transparent hover:bg-red-700 hover:text-white transition duration-200">
                            <i class="fa fa-trash"></i>
                        </button>
                    </center>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="border px-4 py-2 text-center">No departments found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>


</section>