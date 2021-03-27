document.addEventListener('DOMContentLoaded', () => {
    if(document.querySelector('#map')) {
        const lat = 20.666332695977;
        const lng = -103.392177745699;

        const map = L.map('map').setView([lat, lng], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add Marker
        let marker;
        marker = new L.marker([lat, lng]).addTo(map);
    }
});
