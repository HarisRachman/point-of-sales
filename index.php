<!-- <span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html> -->
<?php session_start(); ?>
<?php
if(isset($_SESSION['valid'])) {
	header("location:javascript://history.go(-1)");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style-login.css">
</head>
<body>
<?php
include("api/koneksi.php");

if(isset($_POST['submit'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['password']);

	if($email == "" || $pass == "") {
		echo "Either username or password field is empty.";
		echo "<br/>";
		echo "<a href='login.php'>Go back</a>";
	} else {
		$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password=md5('$pass')")
					or die("Could not execute the select query.");
		
		$row = mysqli_fetch_assoc($result);
		
		if(is_array($row) && !empty($row)) {
			$validuser = $row['email'];
			$_SESSION['valid'] = $validuser;
			$_SESSION['name'] = $row['name'];
			$_SESSION['id'] = $row['id'];
		} else {
			echo "Invalid username or password.";
			echo "<br/>";
			echo "<a href='login.php'>Go back</a>";
		}

		if(isset($_SESSION['valid'])) {
			header('Location: dashboard.php');			
		}
	}
} else {
?>

    <div class="loginbox">
        <!-- <img class="logo" src="logo.png"> -->
        <br>
        <h1>Sign In</h1>
        <form name="form1" method="post" action="">
            <label>Email</label>
            <input type="email" placeholder="Enter Email" name="email">

            <label>Password</label>
            <input type="password" placeholder="Enter Password" name="password">
            
            <input type="submit" name="submit" value="Sign In">
        </form>
        <a href="#">Forgot Password?</a>
    </div>

<?php
}
?>
</body>
</html>
<!-- </span> -->