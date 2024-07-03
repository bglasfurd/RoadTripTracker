<?php
include("connection.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "select * from user where username = '$username'";
        $result = mysqli_query($conn,$query);

        if($result){
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password){
                    header("Location: homepage.php");
                    die;
                }
                else{
                    header("Location: retry-login.php");
                }
            }
        }
        else{
            header("Location: retry-login.php");
        }

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
        #alert{
            position: relative;
            top: 46%;
            left: 35%;
            transform: translate(-50%,-50%);
            color: red;
        }
    </style>
</head>
<body>
    <form method="post">
        <div class="login-box">
            <h1>Login</h1>
            <br>
            <div class="textbox">
                <i class="fa-solid fa-person"></i>
                <input type="text" placeholder="Username" id="1" name="username">
                
            </div>

            <div class="textbox">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="password" id="2" name="password">       
            </div>

            <button class="btn" value="Login">Login</button>
        </div>
        <div id=alert>
            Username or Password is incorrect!
        </div>
    </form>

    <div class="register-link">
        <h5>Don't have an account?</h5>
        <a href="register.php">Register Here!</a>
    </div>

    <script>
        function checkTextField(){
            var u = document.getElementById(1).value;
            var p = document.getElementById(2).value;
            if(u == "" || p == ""){
                alert("Username or password field is empty");
                location.reload();
            }
        }
    </script>
</body>
</html>