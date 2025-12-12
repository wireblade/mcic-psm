@section('title', config('app.name').' |'.' '.$title)

<div>

    <x-map-links />

    <div class="absolute inset-0 z-0" id="map" style="width: 100%; height: 1000px;">
    </div>

    <script>
        // Load saved theme from LocalStorage ('dark' or 'white')
    let isDark = localStorage.getItem("mapTheme") !== "white"; // default = dark

    const projects = @json($projects);

    let labelsVisible = false;
    const labelElements = []; // store labels for toggling

    // Initialize map with saved theme
    const map = new maplibregl.Map({
        container: 'map',
        style: isDark
            ? "https://basemaps.cartocdn.com/gl/dark-matter-gl-style/style.json"
            : "https://basemaps.cartocdn.com/gl/positron-gl-style/style.json",
        center: [121.7740, 12.8797],
        zoom: 6
    });

    updateThemeButton();

    // Add markers, labels, and hitboxes
    projects.forEach(project => {
        const container = document.createElement('div');
        container.style.position = 'relative';
        container.style.width = '0px';
        container.style.height = '0px';
        container.style.cursor = 'pointer';

        // LABEL
        const label = document.createElement('div');
        label.textContent = project.name;
        label.style.fontSize = '12px';
        label.style.color = 'black';
        label.style.background = 'white';
        label.style.padding = '1px 4px';
        label.style.borderRadius = '3px';
        label.style.position = 'absolute';
        label.style.bottom = '10px';
        label.style.left = '50%';
        label.style.transform = 'translateX(-50%)';
        label.style.whiteSpace = 'nowrap';
        label.style.display = 'none';
        container.appendChild(label);
        labelElements.push(label);

        // PIN
        const pin = document.createElement('div');
        pin.style.width = '5px';
        pin.style.height = '5px';
        pin.style.backgroundColor = '#6BF216';
        pin.style.borderRadius = '50%';
        pin.style.border = '1px solid white';
        pin.style.boxShadow = '0 0 4px #000';
        pin.style.position = 'absolute';
        pin.style.bottom = '0';
        pin.style.left = '50%';
        pin.style.transform = 'translateX(-50%)';
        container.appendChild(pin);

        // HITBOX
        const hitbox = document.createElement('div');
        hitbox.style.position = 'absolute';
        hitbox.style.bottom = '0';
        hitbox.style.left = '-10px';
        hitbox.style.width = '30px';
        hitbox.style.height = '30px';
        hitbox.style.background = 'transparent';
        container.appendChild(hitbox);

        // ADD MARKER
        new maplibregl.Marker({
            element: container,
            anchor: 'bottom'
        })
        .setLngLat([project.longitude, project.latitude])
        .addTo(map);

        // POPUP
        const popup = new maplibregl.Popup({
            offset: 10,
            closeButton: true,
            closeOnMove: false
        }).setHTML(`
            <strong>${project.name ?? ''}</strong><br>
            <p>${project.description}</p>
        `);

        // Hitbox click
        hitbox.addEventListener('click', (e) => {
            e.stopPropagation();
            popup.setLngLat([project.longitude, project.latitude]).addTo(map);
        });
    });

    // BUTTON TO TOGGLE LABELS
    document.getElementById('toggleLabels').addEventListener('click', () => {
        labelsVisible = !labelsVisible;

        labelElements.forEach(label => {
            label.style.display = labelsVisible ? 'block' : 'none';
        });

        document.getElementById('toggleLabels').innerText =
            labelsVisible ? 'Hide All Projects' : 'Show All Projects';
    });

    // BUTTON TO TOGGLE MAP THEME AND SAVE IT
    document.getElementById('toggleTheme').addEventListener('click', () => {
        isDark = !isDark;

        // Change map style
        map.setStyle(isDark
            ? "https://basemaps.cartocdn.com/gl/dark-matter-gl-style/style.json"
            : "https://basemaps.cartocdn.com/gl/positron-gl-style/style.json"
        );

        // Save theme in LocalStorage
        localStorage.setItem("mapTheme", isDark ? "dark" : "white");

        // Update icon only
        updateThemeButton();
    });

    // --- FUNCTION TO UPDATE ICON ONLY ---
    function updateThemeButton() {
        const btn = document.getElementById('toggleTheme');

        if (isDark) {
            // DARK MODE → show sun, button is dark
            btn.innerHTML = `<i class="fa fa-sun"></i>`;
            btn.style.backgroundColor = "black";
            btn.style.color = "white";
            btn.style.width = "38px";
        } else {
            // LIGHT MODE → show moon, button is light
            btn.innerHTML = `<i class="fa fa-moon"></i>`;
            btn.style.backgroundColor = "white";
            btn.style.color = "black";
            btn.style.border = "1px solid black";
            btn.style.width = "38px";
        }
    }
    </script>
</div>