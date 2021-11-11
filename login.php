<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include 'partials/_dbconnect.php';
    $uname = $_POST["uname"];
    $password = $_POST["password"];
    
    $sql = "Select * from users where username='$uname'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['uname'] = $uname;
                header("location: welcome.php");
            }
            else {
                $showError = "Invalid credentials type correctly!";
            }
        }
    }
    else {
        $showError = "Invalid credentials type correctly!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/mystyle.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <title>login page</title>
</head>
<body>
    <?php include 'partials/_navbar.php'?>
    <?php
    if ($login) {
        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Success</strong>  You are logged in!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
     if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> '.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
?>
    <div class="row">
        <div class="col-lg-5 m-auto">
            <div class="card mt-5 bg-dark">
                <div class="card-title text-center mt-4">
                    
                </div>
                <div class="card-body mt-4">
                    <form action="/loginsystem/login.php" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user fa-2x"></i>
                                 </span>
                            </div>
                            <input type="text" name="uname" class="form-control" placeholder="username">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock fa-2x"></i>
                                 </span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="password">
                        </div>
                        <button class="btn btn-success">login</button>
                        <p class="text-white my-3 py-3">Not a member? <a href="registration.php">Click to Register.</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
</html>