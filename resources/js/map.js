document.addEventListener('DOMContentLoaded', () => {
    if(document.querySelector('#map')) {
        const lat = 41.37579;
        const lng = 2.15084;

        const map = L.map('map').setView([lat, lng], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add Marker
        let marker;
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(map);

        //Geocode service
        const geocodeService = L.esri.Geocoding.geocodeService();

        //Detects Marker's movement
        marker.on('moveend', function(e) {
            marker = e.target;
            const position = marker.getLatLng();

            //Center Marker on the map
            map.panTo(new L.LatLng(position.lat, position.lng));

            //Reverse Geocoding
            geocodeService.reverse().latlng(position, 16).run(function(error, result) {
                // console.log(error);
                // console.log(result);

                //Show direction
                marker.bindPopup(result.address.LongLabel);
                marker.openPopup();

                fillInputs(result);
            });
        });

        function fillInputs(result) {
            document.querySelector('#address').value = result.address.Address || '';
            document.querySelector('#town').value = result.address.Neighborhood || '';
            document.querySelector('#lat').value = result.latlng.lat || '';
            document.querySelector('#lng').value = result.latlng.lng || '';
        }
    }
});
