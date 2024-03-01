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

$dl_al = false;
$dl_al_un = false;

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

// delete question option

if (isset($_GET['del-q-id'])) 
{
	$g_d_q_i = $_GET['del-q-id'];

	//echo "<script>alert('".strlen($g_d_q_i)."');</script>";
	
	if (strlen($g_d_q_i) > 26 || strlen($g_d_q_i) < 26) 
	{
		echo "<script>alert('Unable to Delete');</script>";
		$dl_al_un = true;

	}
	else
	{
		$delete_q_query = "DELETE FROM `question-table` WHERE `question-table`.`q_id` = '$g_d_q_i'";
		$run_delete_q_query = mysqli_query($conn, $delete_q_query);

		$delete_o_query = "DELETE FROM `option-table` WHERE `option-table`.`q_id` = '$g_d_q_i'";
		$run_delete_o_query = mysqli_query($conn, $delete_o_query);

		if ($run_delete_q_query && $run_delete_o_query) 
		{
			$dl_al = true;
		}
		else
		{
			$dl_al_un = true;
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
	<link rel="stylesheet" type="text/css" href="../css/test-builder-header.css">
	<link rel="stylesheet" type="text/css" href="../css/test-build_ques_c.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">	
	<!-- FontAwesome -->
	<!-- <link rel="stylesheet" href="../ICON/fontawesome-free-5.13.1-web/css/all.css"> -->
	<!-- Jab online hoga tab ke liye --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style type="text/css">
#snackbar 
{
  	visibility: hidden;
  	min-width: 250px;
  	margin-left: -125px;
  	background-color: #333;
  	color: #fff;
  	text-align: center;
  	border-radius: 2px;
  	padding: 16px;
  	position: fixed;
  	z-index: 1000;
  	left: 90%;
  	bottom: 40px;
  	font-size: 17px;
}
#snackbar.show 
{
  	visibility: visible;
  	-webkit-animation: fadein 0.3s, fadeout 0.3s 1.7s;
  	animation: fadein 0.3s, fadeout 0.3s 1.7s;
}
@-webkit-keyframes fadein 
{
  	from 
  	{
  		bottom: 0; 
  		opacity: 0;
  	}
  	to 
  	{
  		bottom: 30px; 
  		opacity: 1;
  	}
}
@keyframes fadein 
{
  	from 
  	{
  		bottom: 0; 
  		opacity: 0;
  	}
  	to 
  	{
  		bottom: 30px; 
  		opacity: 1;
  	}
}
@-webkit-keyframes fadeout 
{
  	from 
  	{
  		bottom: 30px; 
  		opacity: 1;
  	} 
  	to 
  	{
  		bottom: 0; 
  		opacity: 0;
  	}
}
@keyframes fadeout 
{
  	from 
  	{
  		bottom: 30px; 
  		opacity: 1;
  	}
  	to 
  	{
  		bottom: 0; 
  		opacity: 0;
  	}
}
	</style>
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
		<li class="side-bar-ul-li normal active">
			Question
		</li>
		<li class="side-bar-ul-li normal" onclick="window.location.href='setting.php?te-id=<?php echo $test_id; ?>'">
			Setting
		</li>
		<li class="side-bar-ul-li normal" onclick="window.location.href='res-page-dash.php?te-id=<?php echo $test_id; ?>'">
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



<div class="container add-form-c">
	<div class="ad-q-h" onclick="f_q_f()">
			Add Question
	</div>

  <span class="question-type-change">
    <select id="sel_c" onchange="runFun(this.value)" class="sel_q_type">
      <option selected="">Select Question Type</option>
      <option value="mcq_q">Multiple Choice Question</option>
      <option value="tf_q">True/False</option>
    </select>
  </span>

<div id="mcq_q">
	<div class="edit-btn-cont">
        <!-- button container -->
        <button class="edit-btn" onclick="document.execCommand('cut',false,null);" title="cut(Ctrl+x)">
                <i class="fas fa-cut"></i>
            </button>
        <button class="edit-btn" onclick="document.execCommand('copy',false,null);" title="copy(ctrl+c)">
                <i class="far fa-copy"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand('italic',false,null);" title="Italic Text">
            <i class="fas fa-italic"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'bold',false,null);" title="Bold Highlighted Text" title="Bold Text">
            <i class="fas fa-bold"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'underline',false,null);" title="Underline"> 
            <i class="fas fa-underline"></i>
        </button>

        <button class="edit-btn" onclick="document.execCommand( 'justifyLeft',false,null);">
            <i class="fas fa-align-left" title="Align Left"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'justifyCenter',false,null);">
            <i class="fas fa-align-center" title="Align Center"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'justifyRight',false,null);" title="Align Right">
            <i class="fas fa-align-right"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'undo',false,null);" title="Undo">
            <i class="fas fa-undo"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'redo',false,null);" title="Redo">
            <i class="fas fa-redo"></i>
        </button>

        <button class="edit-btn" onclick="document.execCommand('insertOrderedList', false, null);" title="Ordered List">
            <i class="fas fa-list-ol"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand('insertUnorderedList',false, null)" title="Unordered List">
            <i class="fas fa-list-ul"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'subscript',false,null);" title="Subscript">
            <i class="fas fa-subscript"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'superscript',false,null);" title="Superscript">
            <i class="fas fa-superscript"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'strikethrough',false,null);" title="Strikethrough">
            <i class="fas fa-strikethrough"></i>
        </button>
        <br>  
        <label for="fontSize" class="f_s">
            Font size 
            <select class="fontSize" id="fontSize_mcq" onclick="changeSize_mcq()">
                <option value="1">1</option>      
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
        </label>
        <label for="nColor" class="box_c">Highlight 
            <input class="color-box" type="color" onchange="backColor_mcq()" id="nColor_mcq" title="Highlight">
        </label>
        <label for="myColor" class="box_c">Text Colour
            <input class="color-box" type="color" onchange="chooseColor_mcq()" id="myColor_mcq" title="Text color">
        </label>    

    </div>
		<form class="add-form" action="add-question.php" method="post">
			<!--
			<textarea class="add-ques-input" name="question-title" placeholder="Question" required id="f_q" spellcheck="false"></textarea>
			-->

			<div id="editor-area" 
			class="add-ques-input" 
			contenteditable="true"
			spellcheck="false"></div>
            <textarea id="my-textarea" name="question-title" style="display: none;" required></textarea>
			
			<div class="add-option-container">
				<input type="text" class="add-option" name="option-1" placeholder="option-1" required spellcheck="false">
                <input type="text" class="add-option" name="option-2" placeholder="option-2" required spellcheck="false">
                <input type="text" class="add-option" name="option-3" placeholder="option-3" required spellcheck="false">
                <input type="text" class="add-option" name="option-4" placeholder="option-4" required spellcheck="false">
            </div>

			<div class="select-point-container">
				<div class="select-option-div display-inline">
					<select class="ad-sel" name="correct-option" required>
						<option class="ad-sel-op" value="S_C_O">Select Correct Option</option>
						<option class="ad-sel-op" value="option-1">Option-1</option>
						<option class="ad-sel-op" value="option-2">Option-2</option>
						<option class="ad-sel-op" value="option-3">Option-3</option>
						<option class="ad-sel-op" value="option-4">Option-4</option>
					</select>
				</div>

				<div class="point-div display-inline">
					<input type="number" class="point-m" name="point-m" placeholder="Point" required>
				</div>
			</div>

			<div class="add-btn-box">
				<input type="hidden" name="test-id" value="<?php echo $test_id; ?>">
				<button type="submit" name="add-question-mcq"  id="cli_save_int" style="display: none;">ADD</button>

				<button type="button" class="add-btn" onclick="save()">ADD</button>

			</div>
		</form>
</div>
<script type="text/javascript">
  // font size
    function changeSize_mcq(){
      var mysize = document.getElementById("fontSize_mcq").value;
      document.execCommand('fontSize', false, mysize);
    }
    // color scripting
    function chooseColor_mcq(){
      var mycolor = document.getElementById("myColor_mcq").value;
      document.execCommand('foreColor', false, mycolor);
    }
    
    function backColor_mcq(){
      var nColor = document.getElementById("nColor_mcq").value;
      document.execCommand('backColor', false, nColor);
    }
    // getting content from contenteditable div to textarea
    function getContent(){
        document.getElementById("my-textarea").value = document.getElementById("editor-area").innerHTML;
    }
    // after getting content run 
    function save() 
    {
        getContent();
        document.getElementById("cli_save_int").click();
    }
</script>
<div id="tf_q">
    <div class="edit-btn-cont">
        <!-- button container -->
        <button class="edit-btn" onclick="document.execCommand('cut',false,null);" title="cut(Ctrl+x)">
                <i class="fas fa-cut"></i>
            </button>
        <button class="edit-btn" onclick="document.execCommand('copy',false,null);" title="copy(ctrl+c)">
                <i class="far fa-copy"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand('italic',false,null);" title="Italic Text">
            <i class="fas fa-italic"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'bold',false,null);" title="Bold Highlighted Text" title="Bold Text">
            <i class="fas fa-bold"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'underline',false,null);" title="Underline"> 
            <i class="fas fa-underline"></i>
        </button>

        <button class="edit-btn" onclick="document.execCommand( 'justifyLeft',false,null);">
            <i class="fas fa-align-left" title="Align Left"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'justifyCenter',false,null);">
            <i class="fas fa-align-center" title="Align Center"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'justifyRight',false,null);" title="Align Right">
            <i class="fas fa-align-right"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'undo',false,null);" title="Undo">
            <i class="fas fa-undo"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'redo',false,null);" title="Redo">
            <i class="fas fa-redo"></i>
        </button>

        <button class="edit-btn" onclick="document.execCommand('insertOrderedList', false, null);" title="Ordered List">
            <i class="fas fa-list-ol"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand('insertUnorderedList',false, null)" title="Unordered List">
            <i class="fas fa-list-ul"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'subscript',false,null);" title="Subscript">
            <i class="fas fa-subscript"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'superscript',false,null);" title="Superscript">
            <i class="fas fa-superscript"></i>
        </button>
        <button class="edit-btn" onclick="document.execCommand( 'strikethrough',false,null);" title="Strikethrough">
            <i class="fas fa-strikethrough"></i>
        </button>
        <br>  
        <label for="fontSize" class="f_s">
            Font size 
            <select class="fontSize" id="fontSize_tf" onclick="changeSize_tf()">
                <option value="1">1</option>      
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
        </label>
        <label for="nColor" class="box_c">Highlight 
            <input class="color-box" type="color" onchange="backColor_tf()" id="nColor_tf" title="Highlight">
        </label>
        <label for="myColor" class="box_c">Text Colour
            <input class="color-box" type="color" onchange="chooseColor_tf()" id="myColor_tf" title="Text color">
        </label>    

    </div>
    <form class="add-form" action="add-question.php" method="post">

      <div id="editor-area-2" 
      class="add-ques-input" 
      contenteditable="true"
      spellcheck="false"></div>
            <textarea id="my-textarea-2" name="question-title" style="display: none;" required></textarea>
      
      <div class="add-option-container">
        <input type="text" class="add-option" name="option-1" placeholder="option-1" required spellcheck="false" value="True" contenteditable="false">
        <input type="text" class="add-option" name="option-2" placeholder="option-2" required spellcheck="false" value="False">
      </div>

      <div class="select-point-container">
        <div class="select-option-div display-inline">
          <select class="ad-sel" name="correct-option" required>
            <option class="ad-sel-op" value="S_C_O">Select Correct Option</option>
            <option class="ad-sel-op" value="option-1">True</option>
            <option class="ad-sel-op" value="option-2">False</option>
          </select>
        </div>

        <div class="point-div display-inline">
          <input type="number" class="point-m" name="point-m" placeholder="Point" required>
        </div>
      </div>

      <div class="add-btn-box">
        <input type="hidden" name="test-id" value="<?php echo $test_id; ?>">
        <button type="submit" name="add-question-tf"  id="cli_save_int_2" style="display: none;">ADD</button>

        <button type="button" class="add-btn" onclick="save_2()">ADD</button>

      </div>
    </form>
</div>
<script type="text/javascript">
  // font size
  
    function changeSize_tf(){
      var mysize = document.getElementById("fontSize_tf").value;
      document.execCommand('fontSize', false, mysize);
    }
    
    // color scripting
    function chooseColor_tf(){
      var mycolor = document.getElementById("myColor_tf").value;
      document.execCommand('foreColor', false, mycolor);
    }
    
    function backColor_tf(){
      var nColor = document.getElementById("nColor_tf").value;
      document.execCommand('backColor', false, nColor);
    }
    // getting content from contenteditable div to textarea
    function getContent_2(){
        document.getElementById("my-textarea-2").value = document.getElementById("editor-area-2").innerHTML;
    }
    // after getting content run 
    function save_2() 
    {
        getContent_2();
        document.getElementById("cli_save_int_2").click();
    }
</script>
<script type="text/javascript">
    var sel_c = document.getElementById('sel_c').value;
    var mcq_q = document.getElementById('mcq_q');
    var tf_q = document.getElementById('tf_q');

    mcq_q.style.display = "none";
    tf_q.style.display = "none";

    function runFun(value) 
    {
        //alert(value);

        if (value == "mcq_q") 
        {
            //alert("MCQ");
            
            mcq_q.style.display = "";
            tf_q.style.display = "none";
            
        }
        else if (value == "tf_q") 
        {
            //alert("True False");
            
            mcq_q.style.display = "none";
            tf_q.style.display = "";
            
        }
    }
</script>
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

	<!-- preview data -->
	<div class="prev-question-page">
		<div class="prev_data-h display-inline">Preview</div>
		<div class="prev_data display-inline" style="float: right;">
			No. of Question
			<br>
			<span class="big-text-data">
				<?php echo $num_q_h; ?>
			</span>
		</div>
		<div class="prev_data display-inline" style="float: right;">
			Total Marks
			<br>
			<span class="big-text-data">
				<?php echo $total_marks; ?>
			</span>
		</div>

		<div class="prev_data display-inline" style="float: right;">
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

$num_q_h = mysqli_num_rows($run_get_preview_question);

if ($num_q_h <= 0) 
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
	

?>
		<div class="e_d_btn_box_m">
      		<span class="corr-option-prev">Correct Option : <?php echo $correct_option_db;?></span>
      		<span class="e_d_btn_box">
      			<button type="button" 
      					class="e_d_btn delete"
      					onclick="
      					if(confirm('Are you Sure want to Delete'))
          				{window.location.href='question_c.php?te-id=<?php echo $test_id; ?>&del-q-id=<?php echo $question_id_db; ?>'}"
      					>DELETE</button>
      			&nbsp;
      			<button 
      					type="button" 
      					class="e_d_btn" 
      					onclick="window.location.href = 'edit-question.php?te-id=<?php echo $test_id; ?>&ques_id=<?php echo $question_id_db;?>'">
      					EDIT
      			</button>
      		</span>
      	</div>
    </div>

		
<?php
	}
}
?>
</div>
<?php
if ($dl_al) 
{
	echo '<div id="snackbar" class="show">Deleted Successfully</div>';
	echo '
		<input id="counter" value="2" type="hidden">
    	<script>
        	setInterval(function() {
            	var div = document.getElementById("counter");
            	var count = div.value - 1;
            	div.value = count;
            	if (count <= 0) {
                window.location.replace("question_c.php?te-id='.$test_id.'");
            	}
        	}, 1000);
    	</script>';
}
if ($dl_al_un) 
{
	echo '<div id="snackbar" class="show">Unable To Delete</div>';
	echo '
		<input id="counter" value="2" type="hidden">
    	<script>
        	setInterval(function() {
            	var div = document.getElementById("counter");
            	var count = div.value - 1;
            	div.value = count;
            	if (count <= 0) {
                window.location.replace("question_c.php?te-id='.$test_id.'");
            	}
        	}, 1000);
    	</script>';
}
?>
<script type="text/javascript">
	function f_q_f()
	{
		f_q = document.getElementById('editor-area');

		f_q.focus();
	}
</script>
</body>
</html>