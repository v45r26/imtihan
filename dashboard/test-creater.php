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


/* random chracter for question id */

$m=5;
$n=7;
$o=5;
function getName1($m) { 
  $characters1 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString1 = ''; 

  for ($i1 = 0; $i1 < $m; $i1++) { 
    $index1 = rand(0, strlen($characters1) - 1); 
    $randomString1 .= $characters1[$index1]; 
  } 

  return $randomString1; 
}

function getName2($n) { 
  $characters2 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString2 = ''; 

  for ($i2 = 0; $i2 < $n; $i2++) { 
    $index2 = rand(0, strlen($characters2) - 1); 
    $randomString2 .= $characters2[$index2]; 
  } 

  return $randomString2; 
}


function getName3($o) { 
  $characters3 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString3 = ''; 

  for ($i3 = 0; $i3 < $o; $i3++) { 
    $index3 = rand(0, strlen($characters3) - 1); 
    $randomString3 .= $characters3[$index3]; 
  } 

  return $randomString3; 
}

$_rn1 = getName1($m); 
$_rn2 = getName2($n); 
$_rn3 = getName3($o);

$test_id = $_rn1."-".$_rn2."-".$_rn3;

// create test

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$c_test_title = $_POST['test_title'];
	$c_test_status = $_POST['test_status'];
	$c_test_password_status = $_POST['test_password_satus'];
	$c_test_password = $_POST['test_password_v'];

	if (empty($c_test_title) || empty($c_test_status) || empty($c_test_password_status))
	{
		echo "<script>
				alert('Plese fill all the field');
				location = 'index.php';
			</script>";
	}
	else
	{
		if ($c_test_password_status == "Yes") 
		{
			if (empty($c_test_password)) 
			{
				echo "<script>
						alert('Plese fill all the field');
						location = 'index.php';
					</script>";
			}
			else
			{

				$insert_test_query = "INSERT INTO `test-table` (`sno`, `admin_id`, `test_id`, `test_title`, `test_status`, `test_password_status`, `test_password`) VALUES (NULL, '$admin_id', '$test_id', '$c_test_title', '$c_test_status', '$c_test_password_status', '$c_test_password')";
				$run_insert_test_query = mysqli_query($conn, $insert_test_query);

				if ($run_insert_test_query)
				{
					echo "<script>
						alert('Created Successfully !');
						location = 'index.php';
					</script>";
				}
				else
				{
					echo "P Wrong";
					echo "<script>
							alert('Unable to Create your test Plese try Again !');
							location = 'index.php';
						</script>";
				}
			}

		}
		elseif ($c_test_password_status == "None") 
		{
			$insert_test_query = "INSERT INTO `test-table` (`sno`, `admin_id`, `test_id`, `test_title`, `test_status`, `test_password_status`, `test_password`) VALUES (NULL, '$admin_id', '$test_id', '$c_test_title', '$c_test_status', '$c_test_password_status', '$c_test_password')";
			$run_insert_test_query = mysqli_query($conn, $insert_test_query);
			
			if ($run_insert_test_query)
			{
				echo "<script>
						alert('Created Successfully !');
						location = 'index.php';
					</script>";
			}
			else
			{
				echo "<script>
						alert('Unable to Create your test Plese try Again !');
						location = 'index.php';
					</script>";
			}			
		}
	}
}
?>