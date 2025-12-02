<div class="absolute z-50 py-2 px-2">

    <a href="{{@route('map.view')}}">
        <button
            class=" px-3 py-1 shadow-sm shadow-black rounded {{ request()->routeIs('map.view') ? 'bg-white text-black opacity-70' : 'bg-black opacity-60 text-white hover:bg-white hover:text-black hover:opacity-90' }}  transition duration-200">
            <i class="fas fa-spinner fa-spin text-blue-500"></i> Active
        </button>
    </a>

    <a href="{{@route('map.complete')}}">
        <button
            class=" px-3 py-1 shadow-sm shadow-black rounded {{ request()->routeIs('map.complete') ? 'bg-white text-black opacity-70' : 'bg-black opacity-60 text-white hover:bg-white hover:text-black hover:opacity-90' }}  transition duration-200">
            <i class="fas fa-check-circle text-green-500"></i> Completed
        </button>
    </a>

    <a href="{{@route('map.index')}}">
        <button class=" px-3 py-1 shadow-sm shadow-black text-white rounded bg-black opacity-60 hover:bg-white
            hover:text-black hover:opacity-90 transition duration-200 ">
            <i class=" fas fa-tachometer-alt"></i> Dashboard
        </button>
    </a>

</div>

<button
    class="absolute z-50 px-3 py-1 right-4 mt-2 shadow-sm shadow-black text-white rounded bg-black opacity-60 hover:bg-black hover:opacity-100 transition duration-200 "
    id="toggleLabels">
    Show All Projects
</button>

<button id="toggleTheme"
    class="absolute z-50 mt-2 shadow-sm shadow-black right-42 px-3 py-1 text-white rounded bg-black opacity-80 hover:bg-black hover:opacity-100 transition duration-200">
</button>