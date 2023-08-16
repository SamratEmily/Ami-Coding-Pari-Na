<?php
require('api.php');
session_start();

if(isset($_SESSION["email"])) {
    session_destroy();
}

$ref = @$_GET['q'];

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $email = stripslashes($email);
    $email = addslashes($email);
    $pass = stripslashes($pass); 
    $pass = addslashes($pass);

   
    $email = mysqli_real_escape_string($con, $email);
    $pass = mysqli_real_escape_string($con, $pass);		

    $query = "SELECT * FROM user WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($con));
    }

    if(mysqli_num_rows($result) != 1) {
        echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
        echo "<script>window.location.href = 'login.php';</script>";
        exit(); // Make sure to exit the script after redirection
    } else {
        $row = mysqli_fetch_array($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        echo "<center><h3><script>alert('Login Successful');</script></h3></center>";
        echo "<script>window.location.href = 'khuj.php?q=1';</script>";
        exit();
        
    }    

    mysqli_close($con); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <style>
        /* ... */
    </style>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submit">Login</button>
    </form>
    <script src="js/script.js"></script>
</body>
</html>
