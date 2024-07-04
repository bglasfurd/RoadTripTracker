<?php

    session_start();
    include("connection.php");

    $username = $_SESSION["username"];

    $query = "select name from user where username = '$username'";
    $result = mysqli_query($conn,$query);

    $user_data = mysqli_fetch_assoc($result);

    $name = $user_data['name'];


    
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
    <script src="./map_copy.js"></script>

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
            var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + address.value + " India";
            fetch(url)
                  .then(response => response.json())
                  .then(data => addressArr = data)
                  .then(show => putInDB())
                  .catch(err => console.log(err)) 

        }
        
    </script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/OpenLayers.js"></script>
    <script src="./openlayers/libs/v9.2.3-package/dist/ol.js"></script>
</body>
</html>

