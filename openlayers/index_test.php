<?php

    session_start();
    include("connection.php");

    $username = $_SESSION["username"];

    $query = "select name from user where username = '$username'";
    $result = mysqli_query($conn,$query);

    $user_data = mysqli_fetch_assoc($result);

    $name = $user_data['name'];

    
    
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./libs/v9.2.3-package/ol.css">
    <style>
    .map{
        height: 100vh;
        width: 100vw;
    }
    </style>
    
</head>
<body>
    <div id="js-map" class="map"></div>
    <!-- <script type="module" src="./main.js"></script> -->
    <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/OpenLayers.js"></script>
    <script src="./libs/v9.2.3-package/dist/ol.js"></script>
    <script>
        var lon = [77.5946,80.2705,76,75];
        var lat = [12.9716,13.0843,18,14]; 
        var map = new OpenLayers.Map("js-map");
        var mapnik         = new OpenLayers.Layer.OSM();
        var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
        var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
        var position       = new OpenLayers.LonLat(77.5946,12.9716).transform(fromProjection, toProjection);
        var zoom           = 6; 

        map.addLayer(mapnik);
        map.setCenter(position, zoom ); 

        var markers = new OpenLayers.Layer.Markers( "Markers" );
        map.addLayer(markers);
        
        for(let i=0; i<lon.length; i++){
            var lonLat = new OpenLayers.LonLat(lon[i],lat[i]).transform(fromProjection, toProjection); 


            var size = new OpenLayers.Size(20,30);
            var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
            var icon = new OpenLayers.Icon('pinpoint.png', size, offset);
            var marker = new OpenLayers.Marker(lonLat,icon);
            markers.addMarker(marker);
        }

        marker.events.register("click", marker, function(e){
            popup = new OpenLayers.Popup.FramedCloud("",
                                    marker.lonlat,
                                    new OpenLayers.Size(200, 200),
                                    "here lies your information",
                                    null, true);

            map.addPopup(popup);
        }); 
    </script>
</body>
</html>