(function() {
    const mapDiv = document.querySelector('#map');

    if (mapDiv) {
        document.addEventListener('DOMContentLoaded', function() {
            start();
        });
    }

    function start() {
        const lat = -2.147738
        const lng = -79.9658321
        const zoom = 60
        const map = L.map('map').setView([lat, lng], zoom);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup(`
                <h3 class="map__heading">DevWebCamp</h3>
                <p class="map__text">Auditorio Biblioteca ESPOL</p>
            `)
            .openPopup();
    }
})();