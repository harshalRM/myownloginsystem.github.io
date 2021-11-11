<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include 'partials/_dbconnect.php';
    $uname = $_POST["uname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists = false;
    $existSql = "SELECT * FROM `users` WHERE username = '$uname'";
    $result = mysqli_query($conn,$existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $showError = "Username already exists!";
    }
    else {
        if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `email`, `mobile`, `password`) VALUES ('$uname', '$email', '$mobile', '$hash')";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                $showAlert = true;
            }
        }
        else {
            $showError = "Passwords do not match!";
        }
        
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
    <title>registration page</title>
</head>
<body>
<?php include 'partials/_navbar.php'?>
<?php
  if ($showAlert) {
        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Success</strong> Your account is created and can go for login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong>'.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>
    <div class="row">
        <div class="col-lg-5 m-auto">
            <div class="card mt-3 bg-dark">
                <div class="card-title text-center mt-4">
                    <h3 class="text-white">Create Account</h3>
                </div>
                <div class="card-body mt-4">
                    <form action="/loginsystem/registration.php" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user fa-2x"></i>
                                 </span>
                            </div>
                            <input type="text" name="uname" class="form-control" placeholder="username">
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-envelope fa-2x"></i>
                                 </span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-phone fa-2x"></i>
                                 </span>
                            </div>
                            <input type="number" name="mobile" class="form-control" placeholder="Mobile Number">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock fa-2x"></i>
                                 </span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="create password">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock fa-2x"></i>
                                 </span>
                            </div>
                            <input type="password" name="cpassword" class="form-control" placeholder="confirm password">
                        </div>
                        <button class="btn btn-success" href="login.php">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
</html>