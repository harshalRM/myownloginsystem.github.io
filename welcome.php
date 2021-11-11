<?php 
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <title>Welcome - <?php echo $_SESSION['uname']?> </title>
</head>
<body>
    <?php include 'partials/_navbar.php'?>
    <h1 class="title-text"> Harshal's Delicious Cafe</h1>
    <h2 class="h2-text">Welcome - <?php echo $_SESSION["uname"]?></h2> 
    <p class="p-text"> TO THE WORLD OF COFFEE</p>
    
    
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

 
</body>
</html>