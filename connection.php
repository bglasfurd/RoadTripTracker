<?php

    $host = "localhost";
    $dbname = "biking";
    $dbusername = "root";
    $dbpassword = "";

    $conn = mysqli_connect($host,$dbusername,$dbpassword,$dbname);

    if(mysqli_connect_errno()){
        die("Connection error: ". mysqli_connect_error());
    }
?>