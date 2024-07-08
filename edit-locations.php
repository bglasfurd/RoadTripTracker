<?php

    session_start();
    include("connection.php");

    $username = $_SESSION["username"];

    $query = "select name from user where username = '$username'";
    $result = mysqli_query($conn,$query);

    $user_data = mysqli_fetch_assoc($result);

    $name = $user_data['name'];

    if(isset($_POST['delete_loc']))
    {
        $loc_id = mysqli_real_escape_string($conn, $_POST['delete_loc']);

        $query = "DELETE FROM coordinates WHERE latlonID='$loc_id'";
        $query_run = mysqli_query($conn, $query);

        // if($query_run)
        // {
        //     $_SESSION['message'] = "Student Deleted Successfully";
        //     header("Location: index.php");
        //     exit(0);
        // }
        // else
        // {
        //     $_SESSION['message'] = "Student Not Deleted";
        //     header("Location: index.php");
        //     exit(0);
        // }
    }
    
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">


    <title>Student CRUD</title>
</head>
<body>
  
    <div class="container mt-4">

        <!-- <?php include('message.php'); ?> -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo "$name" ?>'s Trip Details
                            <a href="homepage.php" class="btn-danger float-end">
                                <button class = "btn-danger float-end">Return to Homepage</button>
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Location</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM coordinates where username = '$username'";
                                    $query_run = mysqli_query($conn, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $location)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $location['address']; ?></td>
                                                <td><?= $location['lon']; ?></td>
                                                <td><?= $location['lat']; ?></td>
                                                <td>
                                                    <form method="POST" class="d-inline">
                                                        <button type="submit" name="delete_loc" value="<?=$location['latlonID'];?>" class="btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>