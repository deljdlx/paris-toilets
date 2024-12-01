<?php
$json = json_decode(file_get_contents(__DIR__ . '/toilets.json'), true);
?>

<!DOCTYPE html>
<html>
    <head>

        <style>
            html, body {
                margin: 0;
                padding: 0;
            }
        </style>


        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""
        />

    </head>


    <body>
        <div id="leaflet-map" style="height: 100vh"></div>
    </body>


    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>



    <script>
        document.addEventListener('DOMContentLoaded', () => {

            var map = L.map('leaflet-map').setView([48.866667, 2.333333], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);


            <?php
                foreach($json as $toilet) {


                    if($toilet["nom_de_la_commune"] !== "Paris") {
                        continue;
                    }

                    $lat = $toilet['coord_geo']['lat'];
                    $lon = $toilet['coord_geo']['lon'];
                    $desc = $toilet['osm_id'];

                    if($toilet['tarif'] === 'Gratuit') {
                        echo 'var marker = L.marker([' . $lat . ', ' . $lon. ']).addTo(map);';
                        if($toilet['tarif']) {
                            echo 'marker.bindPopup("'. $toilet['tarif'] .'").openPopup();';
                        }
                    }
                }

            ?>

        });
    </script>



</html>
