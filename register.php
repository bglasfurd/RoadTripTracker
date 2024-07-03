<!-- Need to add an alert for when username is taken. Right now all it does is kill the page and user has to hit back button -->


<?php
    
    include("connection.php");

    if($_SERVER['REQUEST_METHOD'] == "POST" && ($_POST["reg_username"] == "" || $_POST["reg_password"] == "")){
        header("Location: register.php");
    }

    else if($_SERVER['REQUEST_METHOD'] == "POST"){
        $reg_username = $_POST["reg_username"];
        $reg_password = $_POST["reg_password"];
        
        $sql = "INSERT INTO user(username,password)
                VALUES ('$reg_username','$reg_password')";
        
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)) {
            die(mysqli_error($conn));
        }

        mysqli_stmt_execute($stmt);
        header("Location: register-form.php");
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post">
        <div class="register-box">
            <h1>Register</h1>
            <div class="register-textbox">
                Enter a username<input type="text" id="1" name="reg_username">
            </div>
            
            <div class="register-textbox">
                Enter a password<input type="password" name="reg_password" id="2">
            </div>

            <div class="register-textbox">
                Re-enter the password<input type="password" onfocusout="checkPass()" name="reg_repassword" id="3">
            </div>            
                
            <button class="btn" onclick="checkPass()">Register</button>
        </div>
    </form>

    <script>
        
        function checkPass(){
            const u = document.getElementById(1).value;
            const p1 = document.getElementById(2).value;
            const p2 = document.getElementById(3).value;
            if(p1 != p2){
                alert("Passwords do not match!");
                location.reload();
            }
            if(p1 == "" || u ==""){
                alert("Username or Password is empty!");
                location.reload();
            }
        }    
    </script>
</body>
</html>

