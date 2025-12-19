@section('title', config('app.name') . ' | ' . $title)

<div wire:ignore>
    <x-map-links />

    <div id="map" style="width:100%; height:1000px;"></div>

    <script>
        let isDark = localStorage.getItem('mapTheme') !== 'white';
        let labelsVisible = false;

        const map = new maplibregl.Map({
            container: 'map',
            style: isDark
                ? 'https://basemaps.cartocdn.com/gl/dark-matter-gl-style/style.json'
                : 'https://basemaps.cartocdn.com/gl/positron-gl-style/style.json',
            center: [121.7740, 12.8797],
            zoom: 6
        });

        updateThemeButton();

        function addProjectLayers() {
            if (map.getSource('finishedProject')) return;

            // SINGLE SOURCE (No clustering)
            map.addSource('finishedProject', {
                type: 'geojson',
                data: '/map/finishedProject.geojson' // async load
            });

            // ALL POINTS
            map.addLayer({
                id: 'projects-pins',
                type: 'circle',
                source: 'finishedProject',
                paint: {
                    'circle-radius': 3, // keep small for performance
                    'circle-color': '#64e764',
                    'circle-stroke-width': 0.9,
                    'circle-stroke-color': isDark ? '#fff' : 'gray'
                }
            });

            // LABELS
            map.addLayer({
                id: 'projects-labels',
                type: 'symbol',
                source: 'finishedProject',
                layout: {
                    'text-field': ['get', 'name'],
                    'text-size': 10,
                    'text-offset': [0, 0.5],
                    'text-anchor': 'top',
                    'visibility': labelsVisible ? 'visible' : 'none'
                },
                paint: {
                    'text-color': isDark ? '#fff' : '#000',
                    'text-halo-color': isDark ? '#000' : '#fff',
                    'text-halo-width': 1
                }
            });

            // POPUP
            map.on('click', 'projects-pins', e => {
                const p = e.features[0].properties;
                new maplibregl.Popup({ offset: 10 })
                    .setLngLat(e.lngLat)
                    .setHTML(`<strong>${p.name}</strong><br>${p.description ?? ''}`)
                    .addTo(map);
            });

            map.on('mouseenter', 'projects-pins', () => map.getCanvas().style.cursor = 'pointer');
            map.on('mouseleave', 'projects-pins', () => map.getCanvas().style.cursor = '');
        }

        map.on('load', addProjectLayers);

        // LABEL TOGGLE
        document.getElementById('toggleLabels')?.addEventListener('click', () => {
            labelsVisible = !labelsVisible;
            map.setLayoutProperty(
                'projects-labels',
                'visibility',
                labelsVisible ? 'visible' : 'none'
            );
            toggleLabels.innerText = labelsVisible ? 'Hide All Projects' : 'Show All Projects';
        });

        // THEME TOGGLE
        document.getElementById('toggleTheme')?.addEventListener('click', () => {
            isDark = !isDark;

            map.setStyle(isDark
                ? 'https://basemaps.cartocdn.com/gl/dark-matter-gl-style/style.json'
                : 'https://basemaps.cartocdn.com/gl/positron-gl-style/style.json'
            );

            localStorage.setItem('mapTheme', isDark ? 'dark' : 'white');
            updateThemeButton();

            map.once('style.load', addProjectLayers);
        });

        function updateThemeButton() {
            const btn = document.getElementById('toggleTheme');
            if (!btn) return;
            btn.innerHTML = isDark ? '☀️' : '🌙';
            
            //   if (isDark) {
            //     btn.innerHTML = '<i class="fa fa-sun"></i>';
            //     btn.style.backgroundColor = 'black';
            //     btn.style.color = 'white';
            // } else {
            //     btn.innerHTML = '<i class="fa fa-moon"></i>';
            //     btn.style.backgroundColor = 'white';
            //     btn.style.color = 'black';
            //     btn.style.border = '1px solid black';
            // }
        }

        document.getElementById('map').style.willChange = 'transform';
    </script>
</div>