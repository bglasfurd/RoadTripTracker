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
	echo $username . "\t";
	print_r($lon);
	print_r($lat);
    
?>