<?php
session_start();

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

if (!isset($_GET['test-id']) || $_GET['test-id'] == "" || empty($_GET['test-id'])) 
{
	header("location: ../dashboard.php");
}
else
{
	$test_id = $_GET['test-id'];

	$check_exist = "SELECT * FROM `test-table` WHERE `test_id` = '$test_id'";
	$run_check_exist = mysqli_query($conn, $check_exist);

	if ($run_check_exist) 
	{
		$no_of_test = mysqli_num_rows($run_check_exist);

		if ($no_of_test > 1 || $no_of_test == 0) 
		{
			header("location: ../dashboard.php");
		}
		else
		{
			// delete query
			$delete_test = "DELETE FROM `test-table` WHERE `test-table`.`test_id` = '$test_id'";
			$run_delete_test = mysqli_query($conn, $delete_test);

			// abhi question answer delete karene ka code baki hai

			if ($run_delete_test) 
			{
				echo"<script>
						alert('Deleted Successfully');
						location = '../dashboard';
					</script>";
			}
			else
			{
				echo"<script>
						alert('Unable to Delete');
						location = '../dashboard';
					</script>";
			}
		}
	}
}

?>