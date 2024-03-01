<?php  

session_start();

if(!isset($_SESSION['loggedin_it']) || $_SESSION['loggedin_it'] != true)
{
	header("location: ../admin-credential/login.php");
   	exit;
}

if(isset($_GET['id']))
{
	$test_id = $_GET['id'];

	include '../dbconnect.php'; // getting connection file
	require('../fpdf/fpdf.php'); // getting fpdf library

	$check_exist = "SELECT * FROM `test-table` WHERE `test_id` = '$test_id'";
	$run_check_exist = mysqli_query($conn, $check_exist);

	if ($run_check_exist) 
	{
		$no_of_test = mysqli_num_rows($run_check_exist);

		if ($no_of_test > 1 || $no_of_test == 0) 
		{
			echo "<script>location = '../error.html';</script>";
		}
		else
		{
			$fetch_test_data = mysqli_fetch_assoc($run_check_exist);
			$test_title = $fetch_test_data['test_title'];
		}
	}

	// creating pdf



	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('helvetica','',16);

	$pdf->Cell(0,10,$test_title,1,1,'C');

	$pdf->Cell(0,8,'',0,1,'C'); // blank line 
	
	$pdf->SetFont('helvetica','',10);

	$q_no = 0;
	$ques_sql = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
	$run_ques_sql = mysqli_query($conn, $ques_sql);

	if ($run_ques_sql) 
	{
		while ($fetch_ques = mysqli_fetch_assoc($run_ques_sql)) 
		{
			$q_no++;
			$q_id = $fetch_ques['q_id'];
			$q_title = $fetch_ques['question-title'];
			$q_point = $fetch_ques['point-marks'];

			$pdf->Cell(8,10,$q_no.'.',0,0,''); // sno
			$pdf->Cell(167,10,$q_title,0,0,'L'); // question
			$pdf->Cell(0,10,$q_point.' point',0,1,'C'); // marks

			$op_no = 0;
			$opt_sql = "SELECT * FROM `option-table` WHERE `q_id` = '$q_id'";
			$run_opt_sql = mysqli_query($conn, $opt_sql);

			if ($run_opt_sql) 
			{
				while ($fetch_opt = mysqli_fetch_assoc($run_opt_sql)) 
				{
					$op_no++;
					$op_title = $fetch_opt['option_title'];

					$pdf->Cell(8,5,'',0,0,'');
					$pdf->Cell(0,5,$op_no.') '.$op_title,0,1,'L'); // sno option
				}
			}
		}
	}
/*
	//only out put result
	$pdf->Output();
*/	

	//download result

	$file_name = $test_title.'_Report_Quizals.pdf';

	$pdf -> output($file_name, 'D');

}
elseif ($_GET['id'] == "" || empty($_GET['id']) || !isset($_GET['id']))
{
	echo "<script>location = '../error.html';</script>";
}
else
{
	echo "<script>location = '../error.html';</script>";
}
?>