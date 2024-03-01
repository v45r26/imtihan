<?php
session_start();

if(!isset($_SESSION['user-logged']) || $_SESSION['user-logged'] != true)
{
  echo '<script>window.location = "log-test.php?t-id='.$_POST['id'].'";</script>';
  exit;
}
 
// indian time zone
date_default_timezone_set("Asia/Kolkata");
$ending_time = date("h:i:s A");


include'dbconnect.php';

if (isset($_POST['submit-test'])) 
{
	$test_id = $_POST['test-id'];
	$test_takers_name = $_SESSION['user-name'];

	// checking test is exist or not
    $test_id_quary = "SELECT * FROM `test-table` WHERE `test_id` = '$test_id'";
    $run_test_id_quary = mysqli_query($conn, $test_id_quary);
    $Num_Exist_Test_Rows = mysqli_num_rows($run_test_id_quary); 

    if($Num_Exist_Test_Rows == 1)
    {
        while($for_test_title = mysqli_fetch_assoc($run_test_id_quary))
        {
            $test_title = $for_test_title['test_title'];
            $dis_res = $for_test_title['at_t_e_display_res'];
            $down_q_p = $for_test_title['download_q_p'];
		}
	}
    $question_option = $_POST['checked-option'];
	$question_id = $_POST['question-id'];
	$no_of_ques = $_POST['no_of_ques'];

	$starting_time = $_POST['starting_time'];
	
	//echo "<br>";

	$sql_data = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
    $run_sql_data = mysqli_query($conn, $sql_data);
    $mm = 0;
    while($fetch_mm = mysqli_fetch_array($run_sql_data))
    {
       	$no = $fetch_mm['point-marks'];
       	$mm += $no;
    }

	$total_marks  = $mm;

	if (!empty($question_option)) 
	{
		$count = count($question_option);
		
		$result = 0;
		$right_attemt = 0;
		$wrong_attemt = 0;

		$i=1;

		while($i<= $no_of_ques) 
		{
			$check_sql = "SELECT * FROM `question-table` WHERE `q_id` = '$question_id[$i]'";
			$run_check_sql = mysqli_query($conn, $check_sql);

			$row = mysqli_fetch_array($run_check_sql); // fetching

			$correct_option_db = $row['correct-option']; // fetching correct option
			$get_point =  $row['point-marks']; // fetching mar
			
			if (empty($question_option[$i])) 
			{
				$question_option[$i] = "empty-option";
			}
			else
			{
				if ($correct_option_db == $question_option[$i]) 
				{
					$right_attemt++;
					$result +=$get_point;
				}
				else
				{
					$wrong_attemt++;
				}
			}
			$i++;
		}	
		
		// Percentage
		$percentage = $result/$total_marks*100;

		$final_percentege = substr($percentage, 0,5);

		if ($percentage > 33) 
		{
			$p_o_f = "PASS";
		}
		else
		{
			$p_o_f = "FAIL";
		}

		// result
		$res_attemt = $count."/".$no_of_ques;
		$res_marks = $result;

	}
	else
	{
		/*
		echo "<script>alert('Plese Select Atleast One');</script>";
		echo "<script>window.location = 'ex-tes.php?id=".$test_id."'</script>";
		*/
		header("location: ex-tes.php?id=".$test_id."&empty_p=true");
	}
}

// time ki pagalpanti
$short_t_1 = substr($starting_time, 0, 8);
$short_t_2 = substr($ending_time, 0, 8);

$time_1 = $short_t_1;
$time_2 = $short_t_2;

$s_t_1 = explode(':', $time_1); // split $time_1
$s_t_2 = explode(':', $time_2); // split $time_2

$t_1_s_0 = $s_t_1[0]; // starting time hr
$t_1_s_1 = $s_t_1[1]; // starting time min
$t_1_s_3 = $s_t_1[2]; // starting time sec
$t_2_s_0 = $s_t_2[0]; // ending time hr 
$t_2_s_1 = $s_t_2[1]; // ending time min
$t_2_s_3 = $s_t_2[2]; // ending time sec

$calc_hr = $t_2_s_0 - $t_1_s_0; // total time taken hr 
$calc_min = $t_2_s_1 - $t_1_s_1; // total time taken min
$calc_sec = $t_1_s_3 - $t_2_s_3; // total time taken sec

if ($calc_hr == 0) {
	$calc_hr = "00";
}
elseif ($calc_hr == 1) {
	$calc_hr = "01";
}
elseif ($calc_hr == 2) {
	$calc_hr = "02";
}
elseif ($calc_hr == 3) {
	$calc_hr = "03";
}
elseif ($calc_hr == 4) {
	$calc_hr = "04";
}
elseif ($calc_hr == 5) {
	$calc_hr = "05";
}
elseif ($calc_hr == 6) {
	$calc_hr = "06";
}
elseif ($calc_hr == 7) {
	$calc_hr = "07";
}
elseif ($calc_hr == 8) {
	$calc_hr = "08";
}
elseif ($calc_hr == 9) {
	$calc_hr = "09";
}
if ($calc_min == 0) {
	$calc_min = "00";
}
elseif ($calc_min == 1) {
	$calc_min = "01";
}
elseif ($calc_min == 2) {
	$calc_min = "02";
}
elseif ($calc_min == 3) {
	$calc_min = "03";
}
elseif ($calc_min == 4) {
	$calc_min = "04";
}
elseif ($calc_min == 5) {
	$calc_min = "05";
}
elseif ($calc_min == 6) {
	$calc_min = "06";
}
elseif ($calc_min == 7) {
	$calc_min = "07";
}
elseif ($calc_min == 8) {
	$calc_min = "08";
}
elseif ($calc_min == 9) {
	$calc_min = "09";
}
if ($calc_sec == 0) {
	$calc_sec = "00";
}
elseif ($calc_sec == 1 || $calc_sec == -1) {
	$calc_sec = "01";
}
elseif ($calc_sec == 2 || $calc_sec == -2) {
	$calc_sec = "02";
}
elseif ($calc_sec == 3 || $calc_sec == -3) {
	$calc_sec = "03";
}
elseif ($calc_sec == 4 || $calc_sec == -4) {
	$calc_sec = "04";
}
elseif ($calc_sec == 5 || $calc_sec == -5) {
	$calc_sec = "05";
}
elseif ($calc_sec == 6 || $calc_sec == -6) {
	$calc_sec = "06";
}
elseif ($calc_sec == 7 || $calc_sec == -7) {
	$calc_sec = "07";
}
elseif ($calc_sec == 8 || $calc_sec == -8) {
	$calc_sec = "08";
}
elseif ($calc_sec == 9 || $calc_sec == -9) {
	$calc_sec = "09";
}
elseif ($calc_sec == -10) {
	$calc_sec = "10";
}
elseif ($calc_sec == -11) {
	$calc_sec = "11";
}
elseif ($calc_sec == -12) {
	$calc_sec = "12";
}
elseif ($calc_sec == -13) {
	$calc_sec = "13";
}
elseif ($calc_sec == -14) {
	$calc_sec = "14";
}
elseif ($calc_sec == -15) {
	$calc_sec = "15";
}
elseif ($calc_sec == -16) {
	$calc_sec = "16";
}
elseif ($calc_sec == -17) {
	$calc_sec = "17";
}
elseif ($calc_sec == -18) {
	$calc_sec = "18";
}
elseif ($calc_sec == -19) {
	$calc_sec = "19";
}
elseif ($calc_sec == -20) {
	$calc_sec = "20";
}
elseif ($calc_sec == -21) {
	$calc_sec = "21";
}
elseif ($calc_sec == -22) {
	$calc_sec = "22";
}
elseif ($calc_sec == -23) {
	$calc_sec = "23";
}
elseif ($calc_sec == -24) {
	$calc_sec = "24";
}
elseif ($calc_sec == -25) {
	$calc_sec = "25";
}
elseif ($calc_sec == -26) {
	$calc_sec = "26";
}
elseif ($calc_sec == -27) {
	$calc_sec = "27";
}
elseif ($calc_sec == -28) {
	$calc_sec = "28";
}
elseif ($calc_sec == -29) {
	$calc_sec = "29";
}
elseif ($calc_sec == -30) {
	$calc_sec = "30";
}
elseif ($calc_sec == -31) {
	$calc_sec = "31";
}
elseif ($calc_sec == -32) {
	$calc_sec = "32";
}
elseif ($calc_sec == -33) {
	$calc_sec = "33";
}
elseif ($calc_sec == -34) {
	$calc_sec = "34";
}
elseif ($calc_sec == -35) {
	$calc_sec = "35";
}
elseif ($calc_sec == -36) {
	$calc_sec = "36";
}
elseif ($calc_sec == -37) {
	$calc_sec = "37";
}
elseif ($calc_sec == -38) {
	$calc_sec = "38";
}
elseif ($calc_sec == -39) {
	$calc_sec = "39";
}
elseif ($calc_sec == -40) {
	$calc_sec = "40";
}
elseif ($calc_sec == -41) {
	$calc_sec = "41";
}
elseif ($calc_sec == -42) {
	$calc_sec = "42";
}
elseif ($calc_sec == -43) {
	$calc_sec = "43";
}
elseif ($calc_sec == -44) {
	$calc_sec = "44";
}
elseif ($calc_sec == -45) {
	$calc_sec = "45";
}
elseif ($calc_sec == -46) {
	$calc_sec = "46";
}
elseif ($calc_sec == -47) {
	$calc_sec = "47";
}
elseif ($calc_sec == -48) {
	$calc_sec = "48";
}
elseif ($calc_sec == -49) {
	$calc_sec = "49";
}
elseif ($calc_sec == -49) {
	$calc_sec = "49";
}
elseif ($calc_sec == -50) {
	$calc_sec = "50";
}
elseif ($calc_sec == -51) {
	$calc_sec = "51";
}
elseif ($calc_sec == -52) {
	$calc_sec = "52";
}
elseif ($calc_sec == -53) {
	$calc_sec = "53";
}
elseif ($calc_sec == -54) {
	$calc_sec = "54";
}
elseif ($calc_sec == -55) {
	$calc_sec = "55";
}
elseif ($calc_sec == -56) {
	$calc_sec = "56";
}
elseif ($calc_sec == -57) {
	$calc_sec = "57";
}
elseif ($calc_sec == -58) {
	$calc_sec = "58";
}
elseif ($calc_sec == -59) {
	$calc_sec = "59";
}
elseif ($calc_sec >= -60 || $calc_sec >= -60) {
	$calc_min++;
}

$total_time_taken = $calc_hr.":".$calc_min.":".$calc_sec; // total time

?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">

	<title>Newtest - <?php echo $test_title; ?></title>
</head>
<body>
	<div class="container col-lg-6 p-4 border" style="margin-top:125px;">
		<div class="container p-3" >
			<h4>Name : <?php echo $test_takers_name; ?></h4>
			<hr>
			<h4>Exam : <?php echo $test_title; ?></h4>
		</div>
		<table class="table text-center table-bordered table-hover">
<?php
if ($dis_res == "" || $dis_res == "on") 
{
	echo '
			<tr class="bg-dark text-light">
				<th>Question Attempted</th>
				<th>Right</th>
				<th>Wrong</th>
				<th>Score</th>
				<th>Percentege</th>
				<th>Report</th>
			</tr>
			<tr>
				<td>'.$res_attemt.'</td>
				<td>'.$right_attemt.'</td>
				<td>'.$wrong_attemt.'</td>
				<td>'.$res_marks.'/'.$total_marks.'</td>
				<td>'.$final_percentege.'%</td>
				<td>'.$p_o_f.'</td>
			</tr>
	';
}
elseif ($dis_res == "off") 
{
	
}
?>
			<tr>
				<td colspan="6">
					<a href="user-logout.php?te-id=<?php echo $test_id; ?>" class="btn btn-danger btn-block">
						LOGOUT
					</a>
				</td>
			</tr>

<?php
if ($down_q_p == "" || $down_q_p == "off") 
{

}
elseif ($down_q_p == "on") {
	echo '
			<tr>
				<td colspan="6">
					<a href="pdf-c/d_question_paper_by_t_t.php?id='.$test_id.'" class="btn btn-success btn-block" target="_blank">
						Download question paper
				</a>
				</td>
			</tr>
	';
}
?>
			
		</table>

	</div>

</body>
</html>
<?php

// submit report

if ($res_attemt > 0) 
{
	$insert_res_query = "INSERT INTO `student-result-table`(`Sno`, `test-id`, `test-takers-name`, `total-question-attempt`, `marks`, `percentege`, `p-o-f`, `starting_time`, `finishing_time`, `total_time_taken`, `rigth_ans`, `wrong_ans`) VALUES (NULL, '$test_id', '$test_takers_name', '$count', '$res_marks', '$final_percentege', '$p_o_f', '$starting_time', '$ending_time', '$total_time_taken', '$right_attemt', '$wrong_attemt')";
	$run_insert_res_query = mysqli_query($conn, $insert_res_query);

	if ($run_insert_res_query) 
	{
		echo "<br><br><center>Submited Successfully !</center>";
	}
	else
	{
		echo "<br><br><center>Unable to Submit!</center>";
	}
}

?>