<div id="map" class="w-full h-96"></div>

<script>
    document.addEventListener('livewire:load', () => {
        const map = L.map('map').setView([12.8797, 121.7740], 6); // Philippines

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        @this.projects.forEach(project => {
            L.marker([project.latitude, project.longitude])
             .addTo(map)
             .bindPopup(`<b>${project.name}</b>`);
        });
    });
</script>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush
@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@endpush