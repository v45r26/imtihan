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

if (!isset($_GET['te-id']) || $_GET['te-id'] == "" || empty($_GET['te-id'])) 
{
	header("location: ../dashboard");
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
			//header("location: ../dashboard");
			header("location: ../dashboard");
		}
		else
		{
			$fetch_test_data = mysqli_fetch_assoc($run_check_exist);
			$test_title_db = $fetch_test_data['test_title'];

			if (!isset($_GET['ques_id']) || $_GET['ques_id'] == "" || empty($_GET['ques_id'])) 
			{
				//echo "h";
				echo "<script>alert('Wrong URL');</script>";
				echo "<script>location='question_c.php?te-id=".$test_id."';</script>";
			}
			else
			{
				$ques_id = $_GET['ques_id'];

				$ques_exist_q = "SELECT * FROM `question-table` WHERE `q_id` = '$ques_id'";
				$run_ques_exist_q = mysqli_query($conn, $ques_exist_q);

				if ($run_ques_exist_q) 
				{
					$nu_o_q = mysqli_num_rows($run_ques_exist_q);

					if ($nu_o_q == 0 || $nu_o_q > 1) 
					{
						echo "<script>alert('Wrong URL');</script>";
						echo "<script>location='question_c.php?te-id=".$test_id."';</script>";
					}
					else
					{
						$fetch_ques = mysqli_fetch_assoc($run_ques_exist_q);
						$fetch_question_db = $fetch_ques['question-title'];
						$fetch_corr_opt_db = $fetch_ques['correct-option'];
						$fetch_point_db = $fetch_ques['point-marks'];

					}
				}
				else
				{
					echo "<script>alert('Wrong URL');</script>";
					echo "<script>location='question_c.php?te-id=".$test_id."';</script>";
				}
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>IMTIHAN - <?php echo $test_title_db; ?></title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Required meta tags Close-->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../image/logo/favicon.png">
    <link rel="shortcut" type="image/x-icon" href="../image/logo/favicon.png">
    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/edit-question.css">	
	<!-- FontAwesome -->
	<!-- <link rel="stylesheet" href="../ICON/fontawesome-free-5.13.1-web/css/all.css"> -->
	<!-- Jab online hoga tab ke liye --> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="container add-form-c">
	<div class="ad-q-h" onclick="f_q_f()">
			Edit Question
	</div>
		<form class="add-form" action="" method="post">
			<textarea class="add-ques-input" name="question-title" placeholder="Question" required id="f_q" spellcheck="false"><?php echo $fetch_question_db;?></textarea>
			
			<div class="add-option-container">
<?php
$O_n = 0;
$get_opt_q = "SELECT * FROM `option-table` WHERE `q_id` = '$ques_id'";
$run_get_opt_q = mysqli_query($conn, $get_opt_q);
if ($run_get_opt_q) 
{
	while ($fetch_opt = mysqli_fetch_assoc($run_get_opt_q)) 
	{
		$O_n++;
		$fetch_option_db = $fetch_opt['option_title'];
?>
				<input type="text" class="add-option" name="option-<?php echo$O_n;?>" placeholder="option-<?php echo$O_n;?>" required spellcheck="false" value="<?php echo $fetch_option_db;?>">
<?php
	}
}
else
{
	echo "<script>alert('Wrong URL');</script>";
	echo "<script>location='question_c.php?te-id=".$test_id."';</script>";
}
?>
            </div>

			<div class="select-point-container">
				<div class="select-option-div display-inline">
					<select class="ad-sel" name="correct-option" required>
						<option class="ad-sel-op" 
								value="<?php echo $fetch_corr_opt_db; ?>">
								<?php echo $fetch_corr_opt_db; ?> [SELECTED]
						</option>
						<option class="ad-sel-op" value="option-1">Option-1</option>
						<option class="ad-sel-op" value="option-2">Option-2</option>
						<option class="ad-sel-op" value="option-3">Option-3</option>
						<option class="ad-sel-op" value="option-4">Option-4</option>
					</select>
				</div>

				<div class="point-div display-inline">
					<input type="number" class="point-m" name="point-m" placeholder="Point" required value="<?php echo $fetch_point_db; ?>">
				</div>
			</div>

			<div class="add-btn-box">
				<!--<button type="submit" name="edit-question" class="add-btn">UPDATE</button>-->
				<button type="button" 
						onclick="window.location  = 'question_c.php?te-id=<?php echo $test_id;?>'"
						class="add-btn"
						style="background-color:  #ff3434;">Cancel</button>
				<button type="submit" name="edit-question" class="add-btn" style="float: right;background-color:  #345aff;">UPDATE</button>
			</div>
		</form>
</div>

<script type="text/javascript">
	f_q = document.getElementById('f_q');
	f_q.focus();
	function f_q_f()
	{
		f_q.focus();
	}
</script>
</body>
</html>
<?php

// update script
//	echo "<script>alert('GOOD!');</script>";
//UPDATE `option-table` SET `option_title` = 'Crud...' WHERE `option-table`.`sno` = 1;
if (isset($_POST['edit-question'])) 
{
	$q_t = $_POST['question-title'];
	$o_1 = $_POST['option-1'];
	$o_2 = $_POST['option-2'];
	$o_3 = $_POST['option-3'];
	$o_4 = $_POST['option-4'];
	$s_crr_op = $_POST['correct-option'];
	$p_m_n = $_POST['point-m'];

	if (empty($q_t) || empty($o_1) || empty($o_2) || empty($o_3) || empty($o_4)) 
	{
		echo "<script>alert('Please fill the field !');</script>";
	}
	else
	{
		
		// update question
		$update_q = "UPDATE `question-table` SET `question-title` = '$q_t',`correct-option` = '$s_crr_op', `point-marks` = '$p_m_n' WHERE `test_id` = '$test_id' AND `q_id` = '$ques_id'";
		$run_update_q = mysqli_query($conn, $update_q);

		// update option-1
		$update_op_1 =  "UPDATE `option-table` SET `option_title` = '$o_1' WHERE `q_id` = '$ques_id' AND `option_no` = 'option-1'";
		$run_update_op_1 = mysqli_query($conn, $update_op_1);


		// update option-2
		$update_op_2 =  "UPDATE `option-table` SET `option_title` = '$o_2' WHERE `q_id` = '$ques_id' AND `option_no` = 'option-2'";
		$run_update_op_2 = mysqli_query($conn, $update_op_2);
		// update option-3
		$update_op_3 =  "UPDATE `option-table` SET `option_title` = '$o_3' WHERE `q_id` = '$ques_id' AND `option_no` = 'option-3'";
		$run_update_op_3 = mysqli_query($conn, $update_op_3);
		// update option-4
		$update_op_4 =  "UPDATE `option-table` SET `option_title` = '$o_4' WHERE `q_id` = '$ques_id' AND `option_no` = 'option-4'";
		$run_update_op_4 = mysqli_query($conn, $update_op_4);

		if ($run_update_q && $run_update_op_1 && $run_update_op_2 && $run_update_op_3 && $run_update_op_4) 
		{
			// same page
			/*
			echo "
				<script>
					alert('Updated Successfully !');
					location = 'edit-question.php?te-id=".$test_id."&ques_id=".$ques_id."';
				</script>";
			*/
			// redirect to question page
			echo "
				<script>
					alert('Updated Successfully !');
					location = 'question_c.php?te-id=".$test_id."';
				</script>";

		}
	}

}

?>
