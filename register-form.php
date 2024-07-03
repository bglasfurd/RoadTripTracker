
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* .register{
            width: 250px;
            position: absolute;
        } */
        .register h1{
            width: 600px;
            font-size: 25px;
            position: absolute;
            left: 30%;
            top: 15%;
        }
        .reg-btn{
            width: 50%;
            position: absolute;
            left:18%;
            background: none;
            border: 2px solid;
            color: white;
            padding: 5px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="register">
        <h1>You have successfully created an account!<h1>
        <br><br>
        <a href="login.php">
            <button class="reg-btn" onclick="goToLogin()">LOGIN</button>
        <a>
    </div>

    <script>
        function goToLogin(){
            location.href = "login.php";
        }
    </script>
</body>
</html>




