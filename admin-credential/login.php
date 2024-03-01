<?php

include '../dbconnect.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>IMTIHAN - Login</title>
	<!-- Required meta tags -->
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<link rel="stylesheet" href="../css/log-sign.css">
</head>
<body>

<div class="container">
  <form action="" method="post">
    <h2>Login</h2>
    <hr>
    <div class="inp-form-cont-group">
      <input type="text" class="inp-form-cont" name="username" placeholder="Username" required="required">
    </div>
    <div class="inp-form-cont-group">
      <input type="password" class="inp-form-cont" name="password" placeholder="Password" required="required">
    </div>
    <button type="Submit" class="log-btn" name="login-btn">Login</button>
    <hr>
    <div class="clearfix mb-3">
      <a href="../admin-credential/signup.php" class="blink">Create an Account</a>
      <a href="#" class="blink f-right">Forgot Password?</a>
    </div>
  </form>
</div>

</body>
</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  	$admin_user_name = $_POST['username'];
	$_password = $_POST['password'];

    
  	$sql = "SELECT * FROM `admin-table` WHERE `admin_username` = '$admin_user_name'";
  	$result = mysqli_query($conn , $sql);
  	$num = mysqli_num_rows($result);

  	if ($num == 1)
  	{
    	while ($row = mysqli_fetch_assoc($result)) 
    	{
      		if($_password == $row['admin_password'])
      		{
        		//$login = true;
        		// sassion started
        		session_start();
        		$_SESSION['loggedin_it'] = true;
        		$_SESSION['admin_user_name'] = $admin_user_name;
                $_SESSION['admin_id'] = $row['admin_id'];
        		header("location: ../index.php");
      		}
      		else
      		{
        		echo "Problem !";
      		}   
    	}
	}
  	else
  	{
    	echo "<script>alert('Plese first create a Account');</script>";
  	}
}
?>