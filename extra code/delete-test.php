<?php
session_start();
/*
if(!isset($_SESSION['loggedin_it']) || $_SESSION['loggedin_it'] != true)
{
	header("location: ../admin-credential/login.php");
   	exit;
}
else
{
//echo "<br><br><br><br>";
	$admin_user_name = $_SESSION['admin_user_name'];
	$admin_id = $_SESSION['admin_id'];
}

include '../dbconnect.php';

if (!isset($_GET['te-id']) || $_GET['te-id'] == "" || empty($_GET['te-id'])) 
{
	header("location: ../dashboard.php");
}
else
{
	$test_id = $_GET['te-id'];

	$check_exist = "SELECT * FROM `test-table` WHERE `test_id` = '$test_id'";
	$run_check_exist = mysqli_query($conn, $check_exist);

	if ($run_check_exist) 
	{
		$no_of_test = mysqli_num_rows($run_check_exist);

		if ($no_of_test > 1 || $no_of_test == 0) 
		{
			header("location: ../dashboard");
		}
	}
}
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>IMTIHAN - Dashboard</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Required meta tags Close-->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../image/logo/favicon.png">
    <link rel="shortcut" type="image/x-icon" href="../../image/logo/favicon.png">
    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../../css/delete-test.css">
</head>
<body>

<div class="container">
	<h2>Are you Sure Want to Delete ?</h2>
	<hr>
	<div class="btn-box">
		<a href="../dashboard" class="btn cancel-bg-color" style="float: left;">Cancel</a>
		<form action="delete-test-query.php" method="get">
			<input type="hidden" name="test-id" value="<?php echo $test_id; ?>">
			<button type="submit" class="btn red-bg-color" name="del-gr-test" style="float: right;">Delete</button>
		</form>
	</div>
</div>

</body>
</html>
