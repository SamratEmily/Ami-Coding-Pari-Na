<?php
	
    include ("api.php");
	session_start();

  //  echo 'Hi';
	if(isset($_POST['submit'] ))
	{	

		$email = $_POST['email'];
		$email = stripslashes($email);
		$email = addslashes($email);

		$password = $_POST['password'];
		$password = stripslashes($password);
		$password = addslashes($password);

        $con = mysqli_connect("localhost", "root", "", "sample");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

		$str="SELECT email from user WHERE email='$email'";
		$result=mysqli_query($con,$str);
		
		if((mysqli_num_rows($result))>0)	
		{
            echo "<center><h3><script>alert('Sorry.. This email is already registered !!');</script></h3></center>";
            header('location: index.html');
        }
		else
		{
			$str="insert into user set email='$email',password='$password'";
			if((mysqli_query($con,$str)))	
			echo "<center><h3><script>alert('Congrats.. You have successfully registered !!');</script></h3></center>";
			header('location: login.php');
		}
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <style>
      
    </style>
</head>
<body>
    <h1>Register</h1>
    <form method="post" action="register.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type = "submit" name="submit">Register</button>
    </form>
    <script src="js/script.js"></script>

</body>
</html>
