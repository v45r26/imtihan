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
	<link rel="stylesheet" type="text/css" href="../css/test_build_dash.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">	
	<!-- FontAwesome -->
	<!-- <link rel="stylesheet" href="../ICON/fontawesome-free-5.13.1-web/css/all.css"> -->
	<!-- Jab online hoga tab ke liye --> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
		<li class="side-bar-ul-li normal active">
			<!--<i class="far fa-tachometer-slowest"></i>-->
			Dashboard
		</li>
		<li class="side-bar-ul-li normal" onclick="window.location.href='question_c.php?te-id=<?php echo $test_id; ?>'">
			<!--<i class="fas fa-question"></i>-->
			Question
		</li>
		<li class="side-bar-ul-li normal" onclick="window.location.href='setting.php?te-id=<?php echo $test_id; ?>'">
			<!--<i class="fas fa-cog"></i>-->
			Setting
		</li>
		<li class="side-bar-ul-li normal" onclick="window.location.href='res-page-dash.php?te-id=<?php echo $test_id; ?>'">
			<!--<i class="fas fa-trophy"></i>-->
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
<?php
$i = 0;
$get_mm_question = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
$run_get_mm_question = mysqli_query($conn, $get_mm_question);

// no of question 
$num_q_h = mysqli_num_rows($run_get_mm_question);

// total marks

$total_marks = 0;

while($t_m_db = mysqli_fetch_array($run_get_mm_question))
{
	$t_m = $t_m_db['point-marks'];
	$total_marks += $t_m;
}

?>
<div class="container">

	<div class="prev-question-page">
		<div class="prev_data-h display-inline">Preview</div>
		<div class="prev_data display-inline">
			No. of Question
			<br>
			<span class="big-text-data">
				<?php echo $num_q_h; ?>
			</span>
		</div>
		<div class="prev_data display-inline">
			Total Marks
			<br>
			<span class="big-text-data">
				<?php echo $total_marks; ?>
			</span>
		</div>

		<div class="prev_data display-inline">
			Download as PDF<br><br>
				<a href="../pdf-c/question-paper.php?id=<?php echo $test_id ?>" target="_blank" class="download-btn" title="Download Question Paper as PDF">DOWNLOAD</a>
		</div>

	</div>

<?php
// preview quiz

// getting question
$i = 0;
$get_preview_question = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
$run_get_preview_question = mysqli_query($conn, $get_preview_question);

if (mysqli_num_rows($run_get_preview_question) <= 0) 
{
	echo '
	<div class="question-prev-question-page">
		<center><b>EMPTY Question Bank ADD Question</b></center>
	</div>
	';
}
else
{
	while($question_row = mysqli_fetch_assoc($run_get_preview_question))
	{
  		$i++;
  
  		$question_title_db = $question_row['question-title'];
  		$question_id_db = $question_row['q_id'];
  		$correct_option_db = $question_row['correct-option'];
  		$point_db = $question_row['point-marks'];

  	echo '
	<div class="question-prev-question-page">
		<div class="question-title-q-p-q-p">
			<span class="no-point">'.$point_db.' Point</span>
			<span class="s-no">'.$i.'&nbsp;</span>
			<div class="q-p">
				'.$question_title_db.'
			</div>
		</div>';

		$get_preview_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db'";
  		$run_get_preview_option = mysqli_query($conn, $get_preview_option);
  		while($option_row = mysqli_fetch_assoc($run_get_preview_option))
  		{
    
	    	$option_sno_db = $option_row['sno'];
	    	$option_title_db = $option_row['option_title'];
	    	$option_no_db = $option_row['option_no'];

    echo '
    	<label class="option-title-q-p-q-p" for="'.$option_sno_db.'-'.$option_title_db.'">
			<input class="option-title-q-p-q-p-radio" type="radio" name="'.$i.'" id="'.$option_sno_db.'-'.$option_title_db.'" value="'.$option_no_db.'">
      		'.$option_title_db.'
		</label>

    ';
		}
	echo '
		<div class="corr-option-prev">Correct Option : '.$correct_option_db.'</div>
	</div>';
	}
}
?>
</div>

</body>
</html>