@section('title', config('app.name').' |'.' '.$title)

<div>
    <a href="{{@route('map.index')}}">
        <button
            class="absolute z-50 px-3 py-1 mt-2 ml-2 text-white rounded bg-gray-500 opacity-50 hover:bg-black hover:opacity-100 transition duration-200  ">
            Dashboard
        </button>
    </a>

    <div class="absolute inset-0 z-0" id="map" style="width: 100%; height: 1000px;">
    </div>


    <link href="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css" rel="stylesheet" />
    <script src="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js"></script>

    <script>
        const projects = @json($projects);

        const map = new maplibregl.Map({
            container: 'map',
            style: 'https://basemaps.cartocdn.com/gl/dark-matter-gl-style/style.json',
            center: [121.7740, 12.8797], // Philippines
            zoom: 6
        });

        projects.forEach(project => {
            // Container for label + pin
            const el = document.createElement('div');
            el.style.display = 'flex';
            el.style.flexDirection = 'column';
            el.style.alignItems = 'center';

            // Label on top
            const label = document.createElement('div');
            label.textContent = project.name;
            label.style.fontSize = '12px';
            label.style.color = 'black';
            label.style.background = 'white';
            label.style.padding = '1px 4px';
            label.style.borderRadius = '3px';
            label.style.marginBottom = '4px'; // space between label and pin
            label.style.whiteSpace = 'nowrap';
            el.appendChild(label);

            // Pin (image or dot)
            const pin = document.createElement('div'); // simple red dot example
            pin.style.backgroundColor = 'red';
            pin.style.width = '10px';
            pin.style.height = '10px';
            pin.style.borderRadius = '50%';
            pin.style.border = '1px solid white';
            pin.style.boxShadow = '0 0 2px #000';
            el.appendChild(pin);

            // Marker anchored at the bottom of the container
            new maplibregl.Marker({ element: el, anchor: 'bottom' })
                .setLngLat([project.longitude, project.latitude])
                .addTo(map);
        });
    </script>
</div>