//leaflet-geosearch
import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {
    if(document.querySelector('#map')) {
        const lat = 41.37579;
        const lng = 2.15084;

        const map = L.map('map').setView([lat, lng], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        //Create marker's layer
        let markers = new L.FeatureGroup().addTo(map);

        // Create Marker
        let marker;
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(map);

        //Add marker to a layer
        markers.addLayer(marker);



        //Geocode service
        const geocodeService = L.esri.Geocoding.geocodeService();

        //Address searcher
        const searcher = document.querySelector('#address-search');
        searcher.addEventListener('blur', searchDirection);

       relocateMarker(marker);

       /**
        *
        * @param {*} marker
        */
       function relocateMarker(marker) {
            //Detects Marker's movement
            marker.on('moveend', function(e) {
                marker = e.target;
                const position = marker.getLatLng();

                //Center Marker on the map
                map.panTo(new L.LatLng(position.lat, position.lng));

                //Reverse Geocoding
                geocodeService.reverse().latlng(position, 16).run(function(error, result) {
                    //Show direction
                    marker.bindPopup(result.address.LongLabel);
                    marker.openPopup();

                    fillInputs(result);
                });
            });
       }

        /**
         * Fill map inputs from the view.
         * @param {*} result
         */
        function fillInputs(result) {
            document.querySelector('#address').value = result.address.Address || '';
            document.querySelector('#town').value = result.address.Neighborhood || '';
            document.querySelector('#lat').value = result.latlng.lat || '';
            document.querySelector('#lng').value = result.latlng.lng || '';
        }

        /**
         * search address with leaflet-geosearch.
         * @param {*} e
         */
        function searchDirection(e) {
            if (e.target.value.length > 10) {
                provider.search({query: e.target.value + ' Barcelona ESP '})
                .then( result => {
                    if (result[0]) {
                        //Clean markers
                        markers.clearLayers();

                        //Reverse Geocoding
                        geocodeService.reverse().latlng(result[0].bounds[0], 16).run(function(error, result) {
                           fillInputs(result);

                           //center Map
                            map.setView(result.latlng);
                           //Add marker
                            marker = new L.marker(result.latlng, {
                                draggable: true,
                                autoPan: true
                            }).addTo(map);

                            markers.addLayer(marker);
                            relocateMarker(marker);
                        });

                        console.log(result[0].bounds[0]);
                    }
                })
                .catch( error => {
                    console.log(error);
                });
            }
        }
    }
});
