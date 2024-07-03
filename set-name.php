<?php

    session_start();  
        
    include("connection.php");

    if($_SERVER['REQUEST_METHOD'] == "POST" && ($_POST["name"] == "")){
        header("Location: set-name.php");
    }

    else if($_SERVER['REQUEST_METHOD'] == "POST"){
        $setname = $_POST["name"];
        $username = $_SESSION["username"];

        $sql = "UPDATE user set name = '$setname' WHERE 
        user.username = '$username'";
            
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)) {
            die(mysqli_error($conn));
        }

        mysqli_stmt_execute($stmt);
        header("Location: homepage.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .setname-box{
            width:300px;
            position: absolute;
            top: 22%;
            left: 35%;
            transform: translate(-50%,-50%);
            color: white;
        }
        .setname-box h1{
            float: left;
            font-size: 33px;
            border-bottom: 6px solid;
            margin-bottom: 50px;
            padding: 14px 0;
        }
    </style>
</head>
<body>
    <form method="post">
        <div class="setname-box">
            <h1>Choose your name</h1>
            <br>
            <div class="textbox">
                <input type="text" placeholder="Name" id="1" name="name">
                
            </div>

            <button class="btn" value="Login" onclick="checkTextField()">Set Name</button>
        </div>
    </form>

    <script>
        function checkTextField(){
            var name = document.getElementById(1).value;
            if(name == ""){
                alert("Name cannot be empty");
                location.reload();
            }
        }
    </script>
</body>
</html>