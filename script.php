<?php
    $Cdata = json_decode($_POST['Cdata'],true);

    include("connection.php");

    $longitude = $Cdata["longitude"];
    $latitude = $Cdata["latitude"];
    $username = $Cdata["username"];
    $address = $Cdata["address"];

    $sql = "INSERT INTO coordinates (address, lon, lat, username, latlonID) 
    VALUES ('$address', '$longitude', '$latitude', '$username', NULL)";
        
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)) {
        die(mysqli_error($conn));
    }

    mysqli_stmt_execute($stmt);
?>
