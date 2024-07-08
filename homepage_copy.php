<?php

    session_start();
    include("connection.php");

    $username = $_SESSION["username"];

    $query = "select name from user where username = '$username'";
    $result = mysqli_query($conn,$query);

    $user_data = mysqli_fetch_assoc($result);

    $name = $user_data['name'];

    $query = "select lon from coordinates where username = '$username'";
    $result = mysqli_query($conn,$query);

	while($row = mysqli_fetch_array($result)) {
		$lon[] = $row['lon'];
	}

	$query = "select lat from coordinates where username = '$username'";
    $result = mysqli_query($conn,$query);

	while($row = mysqli_fetch_array($result)) {
		$lat[] = $row['lat'];
	}
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./openlayers./libs/v9.2.3-package/ol.css">
    <style>
        #js-map{
            position: absolute;
            top: 0px;
            right: 0px;
            height: 100vh;
            width: 60vw;
            border: 14.39px outset black;
        }
        .inputbox{
            width:350px;
            position: absolute;
            top: 15%;
            left: 20%;
            transform: translate(-50%,-50%);
            color: white;
        }
    </style>

</head>
<body>
        <div class="inputbox">
            <h1><?php echo "$name" ?>'s Trip details</h1>
            <div class="textbox">
                <input type="text" placeholder="Location" id="address" name="address">
            </div>

            <!-- <div class="dateholder">
                <input type = "date">
            </div> -->

            <button class="btn" onclick="findCoordinates()">Input</button>

        </div>

    <div id="js-map" class="map"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/OpenLayers.js"></script>
    <script src="./openlayers/libs/v9.2.3-package/dist/ol.js"></script>

    <script>
        map = new OpenLayers.Map("js-map");
        var mapnik         = new OpenLayers.Layer.OSM();
        var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
        var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
        var position       = new OpenLayers.LonLat(77.5946,12.9716).transform(fromProjection, toProjection);
        var zoom           = 6; 

        map.addLayer(mapnik);
        map.setCenter(position, zoom ); 

        var markers = new OpenLayers.Layer.Markers( "Markers" );
        map.addLayer(markers);

        var lon = <?php echo json_encode($lon); ?>;
        var lat = <?php echo json_encode($lat); ?>;
 
        
        for(let i=0; i<lon.length; i++){
            var lonLat = new OpenLayers.LonLat(lon[i],lat[i]).transform(fromProjection, toProjection); 


            var size = new OpenLayers.Size(15,23);
            var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
            var icon = new OpenLayers.Icon('pinpoint.png', size, offset);
            var marker = new OpenLayers.Marker(lonLat,icon);
            markers.addMarker(marker);

            marker.events.register("click", marker, function(e){
            popup = new OpenLayers.Popup.FramedCloud("",
                                    marker.lonlat,
                                    new OpenLayers.Size(200, 200),
                                    "here lies your information",
                                    null, true);

            map.addPopup(popup);
        }); 
    }

    </script>

    <script type = "text/javascript">   
        var address = document.querySelector("#address");

        function putInDB(){

            var Cdata = {};

            Cdata.longitude = addressArr[0].lon;
            Cdata.latitude = addressArr[0].lat;
            Cdata.username = "<?php echo $username ;?>";
            Cdata.address = address.value;

            // let CoordinatesData = {
            //     "longitude": addressArr[0].lon,
            //     "latitude": addressArr[0].lat,
            //     "username": "'<?php echo $username ;?>'",
            // }

            $.ajax({
                url: "script.php",
                method: "POST",
                data: {Cdata: JSON.stringify(Cdata)},
                success: function(res){
                    console.log(res);
                }
            });

            location.reload();

            // fetch("script.php",{
            //     "method": "POST",
            //     "headers": {
            //         "Content-Type": "application/json; charset=utf-8"
            //     },
            //     "body": JSON.stringify(CoordinatesData)
            // })


                        
        }

        function findCoordinates() {
            var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + address.value + ",India";
            fetch(url)
                  .then(response => response.json())
                  .then(data => addressArr = data)
                  .then(show => putInDB())
                  .catch(err => console.log(err)) 

        }
        
    </script>
    
</body>
</html>

