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
			header("location: ../dashboard");
		}
		else
		{
			$fetch_test_data = mysqli_fetch_assoc($run_check_exist);
			$test_title_db = $fetch_test_data['test_title'];

			// tota marks pf test from db
			$sel_mm_sql = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
			$run_sel_mm_sql = mysqli_query($conn, $sel_mm_sql);

			$total_marks_of_test = 0;

			// no of question
			$num_of_ques = mysqli_num_rows($run_sel_mm_sql);

			while ($fe_mm = mysqli_fetch_assoc($run_sel_mm_sql)) 
			{
				$m_m = $fe_mm['point-marks'];
				$total_marks_of_test += $m_m;
			}
		}
	}
}

// short test_title for displaying in side bar
if(strlen($test_title_db) > 14)
{
	$short_test_title = substr($test_title_db, 0,14)."...";
}
else
{
	$short_test_title = $test_title_db;
}

// select data from student-result-table

$get_data_sql = "SELECT * FROM `student-result-table` WHERE `test-id` = '$test_id'";
$run_get_data_sql = mysqli_query($conn, $get_data_sql);

if ($run_get_data_sql) 
{
	$response = mysqli_num_rows($run_get_data_sql); // no of test takers
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
	<link rel="stylesheet" type="text/css" href="../css/test-builder-header.css">
	<link rel="stylesheet" type="text/css" href="../css/res-page-dash.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">	
	<!-- FontAwesome -->
	<!-- <link rel="stylesheet" href="../ICON/fontawesome-free-5.13.1-web/css/all.css"> -->
	<!-- Jab online hoga tab ke liye --> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- data table -->
	<link rel="stylesheet" type="text/css" href="../DATATABLE-PLUGIN/dataTables.css">
</head>
<body>
<!-- HEADER -->
<?php

include 'dash-header.php';

?>

<!-- Side bar -->
<div class="side-bar" id="side-bar">
	<ul class="side-bar-ul">
		<li class="side-bar-ul-li test-title_s_b">
			<?php echo $short_test_title; ?>
		</li>
		<li class="side-bar-ul-li normal" onclick="window.location.href='test-builder.php?te-id=<?php echo $test_id; ?>'">
			Dashboard
		</li>
		<li class="side-bar-ul-li normal" onclick="window.location.href='question_c.php?te-id=<?php echo $test_id; ?>'">
			Question
		</li>
		<li class="side-bar-ul-li normal" onclick="window.location.href='setting.php?te-id=<?php echo $test_id; ?>'">
			Setting
		</li>
		<li class="side-bar-ul-li normal  active">
			Result
		</li>
		<hr>
	</ul>
</div>

<div id="open_close_barr" class="trans_05s">
    <i class="fas fa-angle-right open_close_barr" id="open_barr" onclick="open_side_b()"></i>
    <i class="fas fa-angle-left open_close_barr" 
        id="close_barr" 
        onclick="close_side_b()" 
        style="display: none;"></i>
</div>

<script type="text/javascript">
	var side_bar = document.getElementById('side-bar');
	var open_barr = document.getElementById('open_barr');
	var close_barr = document.getElementById('close_barr');
	var open_close_barr = document.getElementById('open_close_barr');

	function open_side_b() 
	{
		side_bar.style.marginLeft = "0px";
		open_barr.style.display = "none";
		close_barr.style.display = "block";
		open_close_barr.style.marginLeft = "200px";
	}
	function close_side_b()
	{
		side_bar.style.marginLeft = "-201px";
		open_barr.style.display = "block";
		close_barr.style.display = "none";
		open_close_barr.style.marginLeft = "0px";
	}
</script>

<div class="container-test-title">
	<?php echo $test_title_db; ?>
</div>

<div class="prev-container" style="font-family: ;">
	<div class="prev_data display-inline">
			Responses
		<br>
		<span class="big-text-data">
			<?php echo $response; ?>
		</span>
	</div>

	<div class="ex-group" style="float: right;">
		<span class="export_ho">EXPORT</span>
	</div>
		<div class="hover_open">
			<a href="../pdf-c/report-pdf.php?id=<?php echo $test_id; ?>" class="ex-element" target="_blank">PDF</a>
			<a class="ex-element" onclick="alert('Upcomming Feature...')">CSV</a>
			<a class="ex-element" onclick="alert('Upcomming Feature...')">EXEL</a>
		</div>
</div>

<div class="container">
	<div class="table-container">
		<table class="table test-table" id="myTable" name="myTable">
			<thead>
				<br>
				<tr>
					<th scope="col" class="align-left">S No.</th>
					<th scope="col" class="align-left">Name</th>
					<th scope="col" class="align-left">Score</th>
					<th scope="col" class="align-left">Percentege</th>
					<th scope="col" title="Started Time | Finished Time | Total Time" class="align-center">
						Started Time | Finished Time | Total Time
					</th>
					<th scope="col" class="align-left">Attempted</th>
					<th scope="col" class="align-center">Right | Wrong</th>
				</tr>
			</thead>
			<tbody>
				
<?php
// fetch student data
$sno_ =  0;
if ($run_get_data_sql) 
{
	while ($fetch_tst_tkr_dt = mysqli_fetch_assoc($run_get_data_sql)) 
	{	
		$sno_++;
		$test_taker_name = $fetch_tst_tkr_dt['test-takers-name'];
		$total_question_attempt = $fetch_tst_tkr_dt['total-question-attempt'];
		$total_marks = $fetch_tst_tkr_dt['marks'];
		$percentage = $fetch_tst_tkr_dt['percentege'];
		$p_o_f = $fetch_tst_tkr_dt['p-o-f'];
		$starting_time = $fetch_tst_tkr_dt['starting_time'];
		$finishing_time = $fetch_tst_tkr_dt['finishing_time'];
		$total_time_taken = $fetch_tst_tkr_dt['total_time_taken'];
		$rigth_ans = $fetch_tst_tkr_dt['rigth_ans'];
		$wrong_ans = $fetch_tst_tkr_dt['wrong_ans'];

		if ($percentage >= 33) {
			
			$perc = "<span style='color:#0084ff'>".$percentage."%</span>";
		}
		elseif ($percentage <= 32) 
		{
			$perc = "<span style='color:red'>".$percentage."%</span>";
		}

		echo '
				<tr>
					<td>'.$sno_.'</td>
					<td>'.$test_taker_name.'</td>
					<td class="align-center">'.$total_marks.'/'.$total_marks_of_test.'</td>
					<td class="align-center">'.$perc.'</td>
					<td class="align-center">'.$starting_time.' | '.$finishing_time.' | '.$total_time_taken.'</td>
					<td class="align-center">'.$total_question_attempt.'/'.$num_of_ques.'</td>
					<td class="align-center">'.$rigth_ans.' | '.$wrong_ans.'</td>
				</tr>
		';
	}
}

?>
			</tbody>
		</table>
	</div>
</div>

<div class="blank-container-for-breaking-line"></div>

<script src="../bootstrap-4.5.3-dist/jquery/jquery.slim.min.js"></script>
<script src="../DATATABLE-PLUGIN/dataTables.js"></script>
<script>
// data table
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
</script>
</body>
</html>