<?php
session_start();

if(!isset($_SESSION['user-logged']) || $_SESSION['user-logged'] != true)
{
  echo '<script>window.location = "log-test.php?t-id='.$_GET['id'].'";</script>';
  exit;
}

if (isset($_GET['empty_p'])) 
{
    
    echo "<script>alert('Plese Select Atleast One')</script>";
    echo "<script>window.location = 'ex-tes.php?id=". $_GET['id']."'</script>";
}

$test_taker = $_SESSION['user-name'];

// indian time zone
date_default_timezone_set("Asia/Kolkata");
$c_time = date("h:i:s A");

include'dbconnect.php';

if (isset($_GET['id'])) 
{
	$test_id = $_GET['id'];

	if(!$_GET['id'])
    {
        echo "<script>window.location = 'error.html'</script>";
    }
    else
    {
    	// checking test is exist or not
        $test_id_quary = "SELECT * FROM `test-table` WHERE `test_id` = '$test_id'";
        $run_test_id_quary = mysqli_query($conn, $test_id_quary);
        $Num_Exist_Test_Rows = mysqli_num_rows($run_test_id_quary); 

        if($Num_Exist_Test_Rows >= 2 || $Num_Exist_Test_Rows <= 0)
        {
        	echo "<script>window.location = 'error.html'</script>";	
        }
        else
        {
        	$fetch_test_data = mysqli_fetch_assoc($run_test_id_quary);

        	$test_title = $fetch_test_data['test_title'];
            $test_intro = $fetch_test_data['test_intro'];
            $test_theme = $fetch_test_data['test_theme'];
            $test_time = $fetch_test_data['test_time_limit'];
            // aditional setting fetch data
            $d_right_click = $fetch_test_data['d_right_click'];
            $d_copy_paste = $fetch_test_data['d_copy_paste'];
            $d_selection = $fetch_test_data['d_selection'];
            $rand_ques = $fetch_test_data['rand_ques'];
            $rand_opt = $fetch_test_data['rand_opt'];

            // geting no of question
            $get_n_ques = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
            $run_get_n_ques = mysqli_query($conn, $get_n_ques);
            if ($run_get_n_ques) 
            {
                $num_run_get_n_ques = mysqli_num_rows($run_get_n_ques);

                if ($num_run_get_n_ques > 0) 
                {
                    $no_of_q_db = $num_run_get_n_ques;
                }
                else
                {
                    $no_of_q_db = "N/A";
                    echo "<script>window.location = 'error.html'</script>";
                }
                // marks
                $mm = 0;
                while ($fetch_m_m = mysqli_fetch_assoc($run_get_n_ques)) 
                {
                    $m_m_db = $fetch_m_m['point-marks'];

                    $mm += $m_m_db;
                }

                $total_m_m = $mm;

            }

        }
?>
<!DOCTYPE html>
<html>
<head>
	<title>IMTIHAN - <?php echo $test_title; ?></title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="image/logo/favicon.png">
    <link rel="shortcut" type="image/x-icon" href="image/logo/favicon.png">
    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/test-page-h.css"><!-- head title css -->
<?php
if ($test_theme == "default_t" || $test_theme == "") 
{
    echo '
    <link rel="stylesheet" type="text/css" href="css/test-page-default-t.css"><!-- theme -->
    ';
}
elseif ($test_theme == "round_t") {
    echo '
    <link rel="stylesheet" type="text/css" href="css/test-page-round-t.css"><!-- theme -->
    ';
}

?>
    <link rel="stylesheet" type="text/css" href="css/timer.css"><!-- timer css -->

<?php

if ($d_selection == "on" || $d_selection == "On") 
{
    echo '
    <style type="text/css">
        html,body
        {     
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
    ';
}

?>
</head>
<?php

if ($d_copy_paste == "on" || $d_copy_paste == "On") 
{
    if ($d_right_click == "on" || $d_right_click == "On")
    {
        echo '<body oncopy="return false" oncut="return false" onpaste="return false" onload="showTimer()" oncontextmenu="return showContextMenu(event);">';
    }
    elseif ($d_right_click == "off" || $d_right_click == "Off" || $d_right_click == "") 
    {
        echo '<body oncopy="return false" oncut="return false" onpaste="return false" onload="showTimer()">';
    }
}
elseif ($d_copy_paste == "off" || $d_copy_paste == "Off" || $d_copy_paste == "") 
{
    if ($d_right_click == "on" || $d_right_click == "On")
    {
        echo '<body onload="showTimer()" oncontextmenu="return showContextMenu(event);">';
    }
    elseif ($d_right_click == "off" || $d_right_click == "Off" || $d_right_click == "") 
    {
        echo '<body onload="showTimer()">';
    }
}

?>

<?php

if ($test_time == "0" || $test_time == "") 
{
    $test_time = "00";
}

?>

<div class="container test_tite_box">
    Chemistry_1
</div>

<div class="container">
    <div class="test-top-data-box">
        <span class="test-takers-name">Name : <?php echo $test_taker; ?></span>
        <span class="test-total-marks">Total Marks: <?php echo $total_m_m; ?></span>
    </div>
<?php
// if intro word limit == 1 than print
if (strlen($test_intro) > 0) 
{
    echo '
    <hr class="top-d-hr">
<!--
    <h3>Introduction</h3>
-->
    <div>
        '.$test_intro.'
    </div>
    ';
}
?>
</div>

<form action="mark-sheet.php" method="post">
    <input type="hidden" name="test-id" value="<?php echo $test_id; ?>">

<?php

if ($test_theme == "default_t" || $test_theme == "") 
{

    $i = 0;

    if ($rand_ques == "on" || $rand_ques == "On") 
    {
        // print question randomly
        $get_no_question = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
        $run_get_no_question = mysqli_query($conn, $get_no_question);
        $num_of_question = mysqli_num_rows($run_get_no_question);

        $get_question = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id' ORDER BY rand() limit $num_of_question";
        $run_get_question = mysqli_query($conn, $get_question);

        while($question_row = mysqli_fetch_assoc($run_get_question))
        {
            $i++;

            $question_title_db = $question_row['question-title'];
            $question_id_db = $question_row['q_id'];
            $correct_option_db = $question_row['correct-option'];
            $point_db = $question_row['point-marks'];

            echo '
    <div class="question-container">
        <span class="s-no">'.$i.'</span>
        <span class="m-point">'.$point_db.' Point</span>
        <input type="hidden" name="question-id['.$i.']" value="'.$question_id_db.'">
        <div class="question-box">
            <p>'. $question_title_db.'</p>
        </div>
        ';

        // getting option
            if ($rand_opt == "on" || $rand_opt == "On") 
            {
                // print option randomly
                $get_no_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db'";
                $run_get_no_option = mysqli_query($conn, $get_no_option);
                $num_of_option = mysqli_num_rows($run_get_no_option);

                $get_preview_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db' ORDER BY rand() limit $num_of_option";
                $run_get_preview_option = mysqli_query($conn, $get_preview_option);
                while($option_row = mysqli_fetch_assoc($run_get_preview_option))
                {    
                    $option_sno_db = $option_row['sno'];
                    $option_title_db = $option_row['option_title'];
                    $option_no_db = $option_row['option_no'];

                    echo'
        <label class="option-box" for="'.$option_sno_db.'-'.$option_title_db.'">
            <input class="option-rad" type="radio" name="checked-option['.$i.']" id="'.$option_sno_db.'-'.$option_title_db.'" value="'.$option_no_db.'">
            '.$option_title_db.'
        </label>
                ';
                }
            }
            elseif ($rand_opt == "off" || $rand_opt == "Off" || $rand_opt == "") 
            {
                // print option 1 by 1
                $get_preview_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db'";
                $run_get_preview_option = mysqli_query($conn, $get_preview_option);
                while($option_row = mysqli_fetch_assoc($run_get_preview_option))
                {    
                    $option_sno_db = $option_row['sno'];
                    $option_title_db = $option_row['option_title'];
                    $option_no_db = $option_row['option_no'];

                    echo'
        <label class="option-box" for="'.$option_sno_db.'-'.$option_title_db.'">
            <input class="option-rad" type="radio" name="checked-option['.$i.']" id="'.$option_sno_db.'-'.$option_title_db.'" value="'.$option_no_db.'">
            '.$option_title_db.'
        </label>
                ';
                }
            }

            echo '
        <br>
    </div>';
        }
    }
    elseif ($rand_ques == "off" || $rand_ques == "Off" || $rand_ques == "") 
    {
        // print question 1 by 1
        $get_question = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
        $run_get_question = mysqli_query($conn, $get_question);

        while($question_row = mysqli_fetch_assoc($run_get_question))
        {
            $i++;

            $question_title_db = $question_row['question-title'];
            $question_id_db = $question_row['q_id'];
            $correct_option_db = $question_row['correct-option'];
            $point_db = $question_row['point-marks'];

            echo '
    <div class="question-container">
        <span class="s-no">'.$i.'</span>
        <span class="m-point">'.$point_db.' Point</span>
        <input type="hidden" name="question-id['.$i.']" value="'.$question_id_db.'">
        <div class="question-box">
            <p>'. $question_title_db.'</p>
        </div>
        ';
            // getting option
            if ($rand_opt == "on" || $rand_opt == "On") 
            {
                // print option randomly
                $get_no_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db'";
                $run_get_no_option = mysqli_query($conn, $get_no_option);
                $num_of_option = mysqli_num_rows($run_get_no_option);

                $get_preview_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db' ORDER BY rand() limit $num_of_option";
                $run_get_preview_option = mysqli_query($conn, $get_preview_option);
                while($option_row = mysqli_fetch_assoc($run_get_preview_option))
                {    
                    $option_sno_db = $option_row['sno'];
                    $option_title_db = $option_row['option_title'];
                    $option_no_db = $option_row['option_no'];

                    echo'
        <label class="option-box" for="'.$option_sno_db.'-'.$option_title_db.'">
            <input class="option-rad" type="radio" name="checked-option['.$i.']" id="'.$option_sno_db.'-'.$option_title_db.'" value="'.$option_no_db.'">
            '.$option_title_db.'
        </label>
                ';
                }
            }
            elseif ($rand_opt == "off" || $rand_opt == "Off" || $rand_opt == "") 
            {
                // print option 1 by 1
                $get_preview_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db'";
                $run_get_preview_option = mysqli_query($conn, $get_preview_option);
                while($option_row = mysqli_fetch_assoc($run_get_preview_option))
                {    
                    $option_sno_db = $option_row['sno'];
                    $option_title_db = $option_row['option_title'];
                    $option_no_db = $option_row['option_no'];

                    echo'
        <label class="option-box" for="'.$option_sno_db.'-'.$option_title_db.'">
            <input class="option-rad" type="radio" name="checked-option['.$i.']" id="'.$option_sno_db.'-'.$option_title_db.'" value="'.$option_no_db.'">
            '.$option_title_db.'
        </label>
                ';
                }
            }
            echo '
        <br>
    </div>';
        }
    }
}
elseif ($test_theme == "round_t") 
{
    $i = 0;

    if ($rand_ques == "on" || $rand_ques == "On") 
    {
        // print question randomly
        $get_no_question = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
        $run_get_no_question = mysqli_query($conn, $get_no_question);
        $num_of_question = mysqli_num_rows($run_get_no_question);

        $get_question = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id' ORDER BY rand() limit $num_of_question";
        $run_get_question = mysqli_query($conn, $get_question);

        while($question_row = mysqli_fetch_assoc($run_get_question))
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
            <span class="s-no">'.$i.'</span>
                <div class="q-p">'. $question_title_db.'</div>
            <input type="hidden" name="question-id['.$i.']" value="'.$question_id_db.'">
        </div>
        ';

        // getting option
            if ($rand_opt == "on" || $rand_opt == "On") 
            {
                // print option randomly
                $get_no_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db'";
                $run_get_no_option = mysqli_query($conn, $get_no_option);
                $num_of_option = mysqli_num_rows($run_get_no_option);

                $get_preview_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db' ORDER BY rand() limit $num_of_option";
                $run_get_preview_option = mysqli_query($conn, $get_preview_option);
                while($option_row = mysqli_fetch_assoc($run_get_preview_option))
                {    
                    $option_sno_db = $option_row['sno'];
                    $option_title_db = $option_row['option_title'];
                    $option_no_db = $option_row['option_no'];

                    echo'
        <label class="option-title-q-p-q-p" for="'.$option_sno_db.'-'.$option_title_db.'">
            <input class="option-title-q-p-q-p-radio" type="radio" name="checked-option['.$i.']" id="'.$option_sno_db.'-'.$option_title_db.'" value="'.$option_no_db.'">
            '.$option_title_db.'
        </label>
                ';
                }
            }
            elseif ($rand_opt == "off" || $rand_opt == "Off" || $rand_opt == "") 
            {
                // print option 1 by 1
                $get_preview_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db'";
                $run_get_preview_option = mysqli_query($conn, $get_preview_option);
                while($option_row = mysqli_fetch_assoc($run_get_preview_option))
                {    
                    $option_sno_db = $option_row['sno'];
                    $option_title_db = $option_row['option_title'];
                    $option_no_db = $option_row['option_no'];

                    echo'
        <label class="option-title-q-p-q-p" for="'.$option_sno_db.'-'.$option_title_db.'">
            <input class="option-title-q-p-q-p-radio" type="radio" name="checked-option['.$i.']" id="'.$option_sno_db.'-'.$option_title_db.'" value="'.$option_no_db.'">
            '.$option_title_db.'
        </label>
                ';
                }
            }

            echo '
    </div>';
        }
    }
    elseif ($rand_ques == "off" || $rand_ques == "Off" || $rand_ques == "") 
    {
        // print question 1 by 1
        $get_question = "SELECT * FROM `question-table` WHERE `test_id` = '$test_id'";
        $run_get_question = mysqli_query($conn, $get_question);

        while($question_row = mysqli_fetch_assoc($run_get_question))
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
            <span class="s-no">'.$i.'</span>
                <div class="q-p">'. $question_title_db.'</div>
            <input type="hidden" name="question-id['.$i.']" value="'.$question_id_db.'">
        </div>
        ';
            // getting option
            if ($rand_opt == "on" || $rand_opt == "On") 
            {
                // print option randomly
                $get_no_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db'";
                $run_get_no_option = mysqli_query($conn, $get_no_option);
                $num_of_option = mysqli_num_rows($run_get_no_option);

                $get_preview_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db' ORDER BY rand() limit $num_of_option";
                $run_get_preview_option = mysqli_query($conn, $get_preview_option);
                while($option_row = mysqli_fetch_assoc($run_get_preview_option))
                {    
                    $option_sno_db = $option_row['sno'];
                    $option_title_db = $option_row['option_title'];
                    $option_no_db = $option_row['option_no'];

                    echo'
        <label class="option-title-q-p-q-p" for="'.$option_sno_db.'-'.$option_title_db.'">
            <input class="option-title-q-p-q-p-radio" type="radio" name="checked-option['.$i.']" id="'.$option_sno_db.'-'.$option_title_db.'" value="'.$option_no_db.'">
            '.$option_title_db.'
        </label>
                ';
                }
            }
            elseif ($rand_opt == "off" || $rand_opt == "Off" || $rand_opt == "") 
            {
                // print option 1 by 1
                $get_preview_option = "SELECT * FROM `option-table` WHERE `q_id` = '$question_id_db'";
                $run_get_preview_option = mysqli_query($conn, $get_preview_option);
                while($option_row = mysqli_fetch_assoc($run_get_preview_option))
                {    
                    $option_sno_db = $option_row['sno'];
                    $option_title_db = $option_row['option_title'];
                    $option_no_db = $option_row['option_no'];

                    echo'
        <label class="option-title-q-p-q-p" for="'.$option_sno_db.'-'.$option_title_db.'">
            <input class="option-title-q-p-q-p-radio" type="radio" name="checked-option['.$i.']" id="'.$option_sno_db.'-'.$option_title_db.'" value="'.$option_no_db.'">
            '.$option_title_db.'
        </label>
                ';
                }
            }
            echo '
    </div>';
        }
    }
    
}

?>
    <div class="sub-btn-box">
        <input type="hidden" name="test_id_m" value="<?php echo $test_id; ?>">
        <input type="hidden" name="no_of_ques" value="<?php echo $no_of_q_db; ?>">
        <input type="hidden" name="starting_time" value="<?php echo $c_time; ?>">
        <button type="submit" class="submit-btn" id="submit" name="submit-test">SUBMIT</button>
    </div>
</form>
<br /><br /><br />

<!--- timer box -->
    <!--<div class="time-box" id="timer_div">00 : 00 : 00</div>-->

    <div class="fieldset" id="click_to_h_box">
        <div class="legend" align="center" id="click_to_hide" onclick="closeDiv()">
            TIME LEFT &#9660;
        </div>

        <div class="legend" align="center" id="click_to_display" style="display: none" onclick="openDiv()">
            TIME LEFT &#9650;
        </div>

        <div class="time-box" id="timer_div">00 : 00 : 00</div>
    </div>


<audio id="beep_sound_src" src="beep-m/ding.mp3" type="audio/mpeg" style="display: none;">
</audio>

<script type="text/javascript">
var click_to_hide = document.getElementById('click_to_hide');
var click_to_display = document.getElementById('click_to_display');
var click_to_h_box = document.getElementById('click_to_h_box');
// hide timer
function closeDiv()
{
    //alert("clicked");
    click_to_hide.style.display = "none";
    click_to_display.style.display = "block";
    click_to_h_box.style.height = "50px";
    //console.log("closed!")
}
//show timer
function openDiv() 
{
    //alert("clicked");
    click_to_display.style.display = "none";
    click_to_hide.style.display = "block";
    click_to_h_box.style.height = "auto";
    //console.log("Open!")
}

var audio = document.getElementById("beep_sound_src"); // getting audio
// play audio function
function PlaySound() {
  audio.play();
}

//run timer
function showTimer() {

    var take_inpu = document.getElementById('take_inpu');
    var click_submit_btn = document.getElementById('submit');    

    var h = "00";
    var m = "<?php echo $test_time ?>";
    var s = "00";

    var time = h+":"+m+":"+s;
    //var time = "00 : 00 : 02";
    timer_div = document.getElementById('timer_div');

    if (time == "00:00:00" || time == "00:0:00") {
        timer_div.style.fontFamily = "jura";
        time = "UNLIMITED";
        timer_div.innerHTML = time;
    }
    else{

        m_timer = function () {
            var hr = 0; var min = 0; var sec = 0;

            var time_up = false;
        
            t = time.split(":");

            hr = parseInt(t[0]);
            min = parseInt(t[1]);
            sec = parseInt(t[2]);

            if (sec == 0) {

                if (min > 0) {

                    sec = 59;
                    min--;
                
                    if (min > 59 && min < 120) {
                        hr = 1;
                        min -= 60;
                        sec = 59;
                    }
                    else if (min > 119 && min < 180) {
                        hr = 2;
                        min = min - 120;
                        sec = 59;
                    }
                    else if (min > 179 && min < 240) {
                        hr = 3;
                        min = min - 180;
                        sec = 59;
                    }
                    else if (min > 239 && min < 300) {
                        hr = 4;
                        min = min - 240;
                        sec = 59;
                    }
                    else if (min > 299 && min < 360) {
                        hr = 5;
                        min = min - 300;
                        sec = 59;
                    }
                    else if (min > 359 && min < 420) {
                        hr = 6;
                        min = min - 360;
                        sec = 59;
                    }
                }
                else if (hr > 0) {
                    min = 59;
                    sec = 59;
                    hr--;
                }
                else{
                    time_up = true;
                }
            }
            else{
                sec--;
            }
            if (hr < 10) {
                hr = "0"+hr;
            }           
            if (min < 10) {
                min = "0"+min;
            }
            if (sec < 10) {
                sec = "0"+sec;
            }
            if(hr == 0 && min == 0 && sec < 11)
            {
                timer_div.style.color = "#ff1212";
            }
            time = hr+" : "+min+" : "+sec;

            // time up sound
            if (sec == 1) 
            {
                PlaySound();
            }

            if (time_up) {
                timer_div.style.fontFamily = "jura";
                time = "TIME UP";
                click_submit_btn.click();
            }

            timer_div.innerHTML = time;
        }
        setInterval(m_timer ,1000)
    }
}


// ab ye work kar rha hai ab sirf ise test page me add karna hai aur jo time data base se milega min me dal denge
</script>


<?php
// if right click disabled than print

if ($d_right_click == "on" || $d_right_click == "On") 
{
    echo '
    <div class="context-container" oncontextmenu="return showContextMenu(event);">
            <div id="contextMenu" class="context-menu">
                Disabled
            </div>
        </div>
        <script type="text/javascript">

            window.onclick = hideContextMenu;
            window.onkeydown = listenKeys;
            var contextMenu = document.getElementById("contextMenu");

            function showContextMenu (event) {
                contextMenu.style.display = "block";
                contextMenu.style.left = event.clientX + "px";
                contextMenu.style.top = event.clientY + "px";
                return false;
            }

            function hideContextMenu () {
                contextMenu.style.display = "none";
            }

            function listenKeys (event) {
                var keyCode = event.which || event.keyCode;
                if(keyCode == 27){
                    hideContextMenu();
                }
            }

        </script>
    ';
}
elseif ($d_right_click == "off" || $d_right_click == "Off" || $d_right_click == "")  
{
    // kuch nahi karna bsdk  
}
?>
</body>
</html>

<?php
    }
}
else
{
	echo "<script>window.location = 'error.html'</script>";	
}
?>