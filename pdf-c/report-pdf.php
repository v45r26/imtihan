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

	

	// getting total marks
	$sel_mm_sql = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
	$run_sel_mm_sql = mysqli_query($conn, $sel_mm_sql);

	// no of question
	$num_of_ques = mysqli_num_rows($run_sel_mm_sql);

	$total_marks_of_test = 0;

	while ($fe_mm = mysqli_fetch_assoc($run_sel_mm_sql)) 
	{
		$m_m = $fe_mm['point-marks'];
		$total_marks_of_test += $m_m;
	}

	// creating pdf

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('helvetica','',16);

	$pdf->Cell(0,10,$test_title,1,1,'C');
	
	$pdf->SetFont('helvetica','',12);

	$pdf->Cell(12,10,'S no.',1,0);
	$pdf->Cell(55,10,'Name',1,0);
	$pdf->Cell(20,10,'Score',1,0,"C");
	$pdf->Cell(25,10,'Percentage',1,0,"C");
	$pdf->Cell(22,10,'Attempted',1,0,"C");
	$pdf->Cell(15,10,'Right',1,0,"C");
	$pdf->Cell(15,10,'Wrong',1,0,"C");
	$pdf->Cell(0,10,'PASS / FAIL',1,1,"C");

	$pdf->SetFont('helvetica','',10);
	// fetch student data
	$sno_ =  0;

	$get_data_sql = "SELECT * FROM `student-result-table` WHERE `test-id` = '$test_id'";
	$run_get_data_sql = mysqli_query($conn, $get_data_sql);

	$no_of_respone = mysqli_num_rows($run_get_data_sql);

	if ($no_of_respone > 0) 
	{
		while ($fetch_tst_tkr_dt = mysqli_fetch_assoc($run_get_data_sql)) 
		{	
			$sno_++;
			$test_taker_name = $fetch_tst_tkr_dt['test-takers-name'];
			$total_question_attempt = $fetch_tst_tkr_dt['total-question-attempt'];
			$total_marks = $fetch_tst_tkr_dt['marks'];
			$percentage = $fetch_tst_tkr_dt['percentege'];
			$p_o_f = $fetch_tst_tkr_dt['p-o-f'];
			$rigth_ans = $fetch_tst_tkr_dt['rigth_ans'];
			$wrong_ans = $fetch_tst_tkr_dt['wrong_ans'];

			$pdf->Cell(12,10,$sno_,1,0,"C");
			$pdf->Cell(55,10,$test_taker_name,1,0);
			$pdf->Cell(20,10,$total_marks.' / '.$total_marks_of_test,1,0,"C");
			if ($percentage < 32) 
			{
				// fail color
				$pdf->SetTextColor(220,50,50);
			}
			else
			{
				// pass color
				$pdf->SetTextColor(26,114,177);
			}
			$pdf->Cell(25,10,$percentage."%",1,0,"C");
			$pdf->SetTextColor(0,0,0);// black for all
			$pdf->Cell(22,10,$total_question_attempt."/".$num_of_ques,1,0,"C");
			$pdf->Cell(15,10,$rigth_ans,1,0,"C");
			$pdf->Cell(15,10,$wrong_ans,1,0,"C");
			if ($percentage < 32) 
			{
				// fail color
				$pdf->SetTextColor(220,50,50);
			}
			else
			{
				// pass color
				$pdf->SetTextColor(26,114,177);
			}
			$pdf->Cell(0,10,$p_o_f,1,1,"C");
			$pdf->SetTextColor(0,0,0);// black for all			
		}
	}
	else
	{
		$pdf->Cell(0,10,'No data available',1,5,'C');
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