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
			$test_pass_s_db = $fetch_test_data['test_password_status'];
			$test_passd_db = $fetch_test_data['test_password'];
			$test_intro_db = $fetch_test_data['test_intro'];
			$test_theme_db = $fetch_test_data['test_theme'];
			$test_time_l_db = $fetch_test_data['test_time_limit'];
			$right_click_db = $fetch_test_data['d_right_click'];
			$copy_paste_db = $fetch_test_data['d_copy_paste'];
			$selection_db = $fetch_test_data['d_selection'];
			$rand_ques_db = $fetch_test_data['rand_ques'];
			$rand_opt_db = $fetch_test_data['rand_opt'];
			$download_q_p = $fetch_test_data['download_q_p'];
			$display_res_aft_test = $fetch_test_data['at_t_e_display_res'];
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
	<link rel="stylesheet" type="text/css" href="../css/setting.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">	
	<!-- FontAwesome -->
	<!-- <link rel="stylesheet" href="../ICON/fontawesome-free-5.13.1-web/css/all.css"> -->
	<!-- Jab online hoga tab ke liye --> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
			<!--<i class="far fa-tachometer-slowest"></i>-->
			Dashboard
		</li>
		<li class="side-bar-ul-li normal" onclick="window.location.href='question_c.php?te-id=<?php echo $test_id; ?>'">
			<!--<i class="fas fa-question"></i>-->
			Question
		</li>
		<li class="side-bar-ul-li normal active">
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


<div class="container">
	<div class="ch-name-h" onclick="u_t_q_f()">Test Title</div>
	<form action="" method="post" class="c-t-f">
		<input type="text" class="ch-t-t" name="test-title" value="<?php echo $test_title_db; ?>" required id="q_f">
		<br>
		<button type="reset" class="ch-t-t-b"style="float: left;">Reset</button>
		<button type="submit" name="up-t-t" class="ch-t-t-b" style="float: right;">UPDATE</button>
	</form>
</div>

<div class="container">
	<div class="intro-h" onclick="a_i_q_f()">Test Introduction</div>
	<small>This text is displayed at the top of the test. You can use it to write your instructions. It can be blank.</small>
	
	<br><br>
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
            <select class="fontSize" id="fontSize" onclick="changeSize()">
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
            <input class="color-box" type="color" onchange="backColor()" id="nColor" title="Highlight">
        </label>
        <label for="myColor" class="box_c">Text Colour
            <input class="color-box" type="color" onchange="chooseColor()" id="myColor" title="Text color">
        </label>    

    </div>
	<form action="" method="post" class="c-t-f" id="editor_form">

		<div id="editor-area" 
			class="test-intro"  
			placeholder="Introduction..." 
			contenteditable="true"
			spellcheck="false"><?php echo $test_intro_db; ?></div>
            <textarea id="my-textarea" name="test-intro" required style="display: none;"></textarea>

		<button type="button" class="ch-t-t-b" onclick="save()" style="float: right;">save</button>
		<button type="submit" name="add-intro" id="cli_save_int" style="display: none;">Add Introduction</button>
	</form>
</div>
<script type="text/javascript">
	// font size
    function changeSize(){
      var mysize = document.getElementById("fontSize").value;
      document.execCommand('fontSize', false, mysize);
    }
    // color scripting
    function chooseColor(){
      var mycolor = document.getElementById("myColor").value;
      document.execCommand('foreColor', false, mycolor);
    }
    
    function backColor(){
      var nColor = document.getElementById("nColor").value;
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
<div class="container">
	<div class="theme-name-h">Theme Seletor</div>
	<form action="" method="post">

		<div class="theme-container">

<?php
// jab theme ban jayega tab is code ko setting page me theme change container me paste kar dena hai 
if($test_theme_db == "default_t" || $test_theme_db == "") 
{
	echo '
			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-1" checked value="default_t">
			<label class="theme-selector-cont rad-t-1" for="rad-t-1">
				<div class="theme-img"><img src="../IMAGE/theme_img/F_T_Q_W_2.jpeg"></div>
				<div class="theme-data">Default_Quizer</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-2" value="round_t">
			<label class="theme-selector-cont rad-t-2" for="rad-t-2">
				<div class="theme-img"><img src="../IMAGE/theme_img/S_T_Q_W_2.jpeg"></div>
				<div class="theme-data">Round_Quizer</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-3" value="red-t" disabled>
			<label class="theme-selector-cont rad-t-3" for="rad-t-3">
				<div class="theme-img"></div>
				<div class="theme-data">UPCOMMING THEME...</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-4" value="grey-t" disabled>
			<label class="theme-selector-cont rad-t-4" for="rad-t-4">
				<div class="theme-img"></div>
				<div class="theme-data">UPCOMMING THEME...</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-5" value="black-t" disabled>	
			<label class="theme-selector-cont rad-t-5" for="rad-t-5">
				<div class="theme-img"></div>
				<div class="theme-data">UPCOMMING THEME...</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-6" value="oth-t" disabled>	
			<label class="theme-selector-cont rad-t-6" for="rad-t-6">
				<div class="theme-img"></div>
				<div class="theme-data">UPCOMMING THEME...</div>
			</label>
	';	
}
elseif ($test_theme_db == "round_t") 
{
	echo '
			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-1" value="default_t">
			<label class="theme-selector-cont rad-t-1" for="rad-t-1">
				<div class="theme-img"><img src="../IMAGE/theme_img/F_T_Q_W_2.jpeg"></div>
				<div class="theme-data">Default_Quizer</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-2" value="round_t" checked>
			<label class="theme-selector-cont rad-t-2" for="rad-t-2">
				<div class="theme-img"><img src="../IMAGE/theme_img/S_T_Q_W_2.jpeg"></div>
				<div class="theme-data">Round_Quizer</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-3" value="red-t" disabled>
			<label class="theme-selector-cont rad-t-3" for="rad-t-3">
				<div class="theme-img"></div>
				<div class="theme-data">UPCOMMING THEME...</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-4" value="grey-t" disabled>
			<label class="theme-selector-cont rad-t-4" for="rad-t-4">
				<div class="theme-img"></div>
				<div class="theme-data">UPCOMMING THEME...</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-5" value="black-t" disabled>	
			<label class="theme-selector-cont rad-t-5" for="rad-t-5">
				<div class="theme-img"></div>
				<div class="theme-data">UPCOMMING THEME...</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-6" value="oth-t" disabled>	
			<label class="theme-selector-cont rad-t-6" for="rad-t-6">
				<div class="theme-img"></div>
				<div class="theme-data">UPCOMMING THEME...</div>
			</label>
	';
}
?>
		</div>

		<div class="theme-btn-cont">
			<button type="submit" name="save-theme" class="theme-btn" style="float: right">Save</button>
		</div>

	</form>

</div>

<div class="container">
	<div class="time-name-h">Time Limit</div>

<?php

if ($test_time_l_db == "" || $test_time_l_db == 0 || $test_time_l_db == "0") 
{
	echo '
		<form action="" method="post">
			
			<label class="time-cont" for="unlimited_t">
					<input type="radio" name="time-limit-min" id="unlimited_t" value="unlimited" checked>
    	        	UNLIMITED
    	    </label>
    	    <br>
            <label class="time-cont" for="enter_time">
            		<input type="radio" name="time-limit-min" id="enter_time" value="enter-time-m">
            		Enter Time <input type="number" id="enter_time_m" disabled name="enter-time-m" min="1" max="999"> in Min
            </label>
            
            <button type="submit" name="save-t-l" class="time-limit-btn" style="float: right;">Save</button>
		</form>
	';
}
elseif($test_time_l_db >= 1 || $test_time_l_db >0)
{
	echo '
		<form action="" method="post">
			
				<label class="time-cont" for="unlimited_t">
					<input type="radio" name="time-limit-min" id="unlimited_t" value="unlimited">
    	        	UNLIMITED
    	        </label>
    	    
    	    	<br>
    	    	<label class="time-cont" for="enter_time">
            		<input type="radio" name="time-limit-min" id="enter_time" value="enter-time-m" checked>
            		Enter Time <input type="number" id="enter_time_m" disabled name="enter-time-m" value="'.$test_time_l_db.'" min="1" max="999"> in Min
            	</label>
            
            <button type="submit" name="save-t-l" class="time-limit-btn" style="float: right;">Save</button>
		</form>
	';
}
?>
</div>

<div class="container">
	<div class="additional-s-h">Additional Settings</div>
	<form action="" method="post">
<?php

if ($right_click_db == "" || $right_click_db == "off") 
{
	echo '
		<label class="check-box-cont" for="a-s-1">
			<input type="hidden" name="d-r-c-c-m" value="off">
			<input type="checkbox" name="d-r-c-c-m" id="a-s-1" value="on">
			Disable right-click context menu
		</label>
	';
}
elseif ($right_click_db == "on") 
{
	echo '
		<label class="check-box-cont" for="a-s-1">
			<input type="hidden" name="d-r-c-c-m" value="off">
			<input type="checkbox" name="d-r-c-c-m" id="a-s-1" value="on" checked>
			Disable right-click context menu
		</label>
	';
}
if ($copy_paste_db == "" || $copy_paste_db == "off") 
{
	echo '
		<label class="check-box-cont" for="a-s-2">
			<input type="hidden" name="d-c-p" value="off">
			<input type="checkbox" name="d-c-p" id="a-s-2" value="on">
			Disable copy/paste 
		</label>
	';
}
elseif ($copy_paste_db == "on") 
{
	echo '
		<label class="check-box-cont" for="a-s-2">
			<input type="hidden" name="d-c-p" value="off">
			<input type="checkbox" name="d-c-p" id="a-s-2" value="on" checked>
			Disable copy/paste
		</label>
	';
}
if ($selection_db == "" || $selection_db == "off") 
{
	echo '
		<label class="check-box-cont" for="a-s-3">
			<input type="hidden" name="d-sel" value="off">
			<input type="checkbox" name="d-sel" id="a-s-3" value="on">
			Disable Selection
		</label>
	';
}
elseif ($selection_db == "on") 
{
	echo '
		<label class="check-box-cont" for="a-s-3">
			<input type="hidden" name="d-sel" value="off">
			<input type="checkbox" name="d-sel" id="a-s-3" value="on" checked>
			Disable Selection
		</label>
	';
}
if ($rand_ques_db == "" || $rand_ques_db == "off") 
{
	echo '
		<label class="check-box-cont" for="a-s-4">
			<input type="hidden" name="rand-ques" value="off">
			<input type="checkbox" name="rand-ques" id="a-s-4" value="on">
			Randomize Question
		</label>
	';
}
elseif ($rand_ques_db == "on") 
{
	echo '
		<label class="check-box-cont" for="a-s-4">
			<input type="hidden" name="rand-ques" value="off">
			<input type="checkbox" name="rand-ques" id="a-s-4" value="on" checked>
			Randomize Question
		</label>
	';
}
if ($rand_opt_db == "" || $rand_opt_db == "off") 
{
	echo '
		<label class="check-box-cont" for="a-s-5">
			<input type="hidden" name="rand-opt" value="off">
			<input type="checkbox" name="rand-opt" id="a-s-5" value="on">
			Randomize Option
		</label>
	';
}
elseif ($rand_opt_db == "on") 
{
	echo '
		<label class="check-box-cont" for="a-s-6">
			<input type="hidden" name="rand-opt" value="off">
			<input type="checkbox" name="rand-opt" id="a-s-6" value="on" checked>
			Randomize Option
		</label>
	';
}
if ($display_res_aft_test == "off") 
{
	echo '
		<label class="check-box-cont" for="a-s-6">
			<input type="hidden" name="dis_re_a_t" value="off">
			<input type="checkbox" name="dis_re_a_t" id="a-s-6" value="on">
			Display Result After Test
		</label>
	';
}
elseif ($display_res_aft_test == "" || $display_res_aft_test == "on") 
{
	echo '
		<label class="check-box-cont" for="a-s-6">
			<input type="hidden" name="dis_re_a_t" value="off">
			<input type="checkbox" name="dis_re_a_t" id="a-s-6" value="on" checked>
			Display Result After Test
		</label>
	';
}
if ($download_q_p == "" || $download_q_p == "off") 
{
	echo '
		<label class="check-box-cont" for="a-s-7">
			<input type="hidden" name="download_q_p" value="off">
			<input type="checkbox" name="download_q_p" id="a-s-7" value="on">
			Download Question Paper After Test
		</label>
	';
}
elseif ($download_q_p == "on") 
{
	echo '
		<label class="check-box-cont" for="a-s-7">
			<input type="hidden" name="download_q_p" value="off">
			<input type="checkbox" name="download_q_p" id="a-s-7" value="on" checked>
			Download Question Paper After Test
		</label>
	';
}

?>
		<button type="submit" name="a-s-btn" class="ad-s-btn" style="float: right;">Save</button>
	</form>
</div>

<?php

if ($test_pass_s_db == "None" || $test_pass_s_db == "none") 
{
	echo '
<div class="container">
	<div class="pass-name-h">Change Password Status & Password</div>
	<form action="" method="post">
		<div class="pass-stat-cont">
			<label for="c-p-s-1" class="lab-c-p">
				<input type="radio" name="c-p-s-t" value="Yes" id="c-p-s-1">
				Yes
			</label>
			<input type="hidden" name="new-test-password" value="010010001none">
			<label for="c-p-s-2" class="lab-c-p">
				<input type="radio" name="c-p-s-t" value="None" id="c-p-s-2" checked>
				No
			</label>
		</div>
		<div class="password-cont">
			<input type="text" class="password-cont-i" name="new-test-password" id="c_p" placeholder="Enter New Password..." disabled>
		</div>
		<button type="submit" name="u-t-pass" class="ad-s-btn" style="float: right;">UPDATE</button>
	
	</form>
</div>
<script type="text/javascript">
	var c_yes = document.getElementById("c-p-s-1");
	var c_no = document.getElementById("c-p-s-2");
	var c_c_p = document.getElementById("c_p");

	if (c_yes.checked)
    {
        c_c_p.removeAttribute("disabled", "false");
    }
    if (c_no.checked)
    {
    	c_c_p.setAttribute("disabled", "true");
        c_c_p.value = "Disabled";
    }
    c_yes.addEventListener("change",function() 
    {
        if (c_yes.checked)
        {
            c_c_p.removeAttribute("disabled", "false");
            c_c_p.focus();
            c_c_p.value = "";
        }
    });
    c_no.addEventListener("change",function() 
    {
        if (c_no.checked)
        {
            c_c_p.setAttribute("disabled", "true");
            c_c_p.value = "Disabled";
        }
    });
</script>
	';
}
elseif ($test_pass_s_db == "Yes" || $test_pass_s_db == "yes") 
{
	echo '
<div class="container">
	<input type="hidden" value="'.$test_passd_db.'" id="getting_pass">
	<div class="pass-name-h">Change Password Status & Password</div>
	<form action="" method="post">
		<div class="pass-stat-cont">
			<label for="c-p-s-1" class="lab-c-p">
				<input type="radio" name="c-p-s-t" value="Yes" id="c-p-s-1" checked>
				Yes
			</label>
			<input type="hidden" name="new-test-password" value="010010001none">
			<label for="c-p-s-2" class="lab-c-p">
				<input type="radio" name="c-p-s-t" value="None" id="c-p-s-2">
				No
			</label>
		</div>
		<div class="password-cont">
			<input type="text" class="password-cont-i"  name="new-test-password" id="c_p" placeholder="Enter New Password..." value="'.$test_passd_db.'">
		</div>
		<button type="submit" name="u-t-pass" class="ad-s-btn" style="float: right;">UPDATE</button>
	
	</form>
</div>
<script type="text/javascript">
	var c_yes = document.getElementById("c-p-s-1");
	var c_no = document.getElementById("c-p-s-2");
	var c_c_p = document.getElementById("c_p");
	var g_p_db = document.getElementById("getting_pass");

	if (c_yes.checked)
    {
        c_c_p.removeAttribute("disabled", "false");
    }
    if (c_no.checked)
    {
    	c_c_p.setAttribute("disabled", "true");
        c_c_p.value = "Disabled";
    }
    c_yes.addEventListener("change",function() 
    {
        if (c_yes.checked)
        {
            c_c_p.removeAttribute("disabled", "false");
            c_c_p.focus();
            c_c_p.value = g_p_db.value;
        }
    });
    c_no.addEventListener("change",function() 
    {
        if (c_no.checked)
        {
            c_c_p.setAttribute("disabled", "true");
            c_c_p.value = "Disabled";
        }
    });
</script>
	';
}

?>


<script type="text/javascript">
	function u_t_q_f()
	{
		f_q = document.getElementById('q_f');

		f_q.focus();
	}
	function a_i_q_f()
	{
		f_q = document.getElementById('editor-area');

		f_q.focus();
	}
	var unlimited_t = document.getElementById('unlimited_t');

    var enter_time = document.getElementById('enter_time');

    var enter_time_m = document.getElementById('enter_time_m');

    if (enter_time.checked)
    {
        enter_time_m.removeAttribute("disabled", "false");
    }

    enter_time.addEventListener('change',function() 
    {
        if (enter_time.checked)
        {
            enter_time_m.removeAttribute("disabled", "false");
            enter_time_m.focus();
        }
    });

    unlimited_t.addEventListener('change',function() 
    {
        if (unlimited_t.checked)
        {
            enter_time_m.setAttribute("disabled", "true");
        }
    });
</script>

<div class="blank-container-for-breaking-line"></div>


</body>
</html>
<?php
// update test-title
if (isset($_POST['up-t-t'])) 
{
	
	$test_title_u = $_POST['test-title'];

	$update_t_t_q = "UPDATE `test-table` SET `test_title` = '$test_title_u' WHERE
	`test_id` = '$test_id'"; 
	$run_update_t_t_q = mysqli_query($conn,	$update_t_t_q);

	if ($run_update_t_t_q) 
	{
		echo "
			<script>
					alert('Updated Successfully !');
					location = 'setting.php?te-id=".$test_id."';
			</script>
		";
	}
	else
	{
		echo "<script>
					alert('Unable to Update !');
					location = 'setting.php?te-id=".$test_id."';
			</script>";
	}
	/*
	echo "<script>
					alert('Updated Successfully !');
		</script>";*/
}
// add intro
if (isset($_POST['add-intro'])) 
{
	$test_intrr = $_POST['test-intro'];

	$add_t_i_q = "UPDATE `test-table` SET `test_intro` = '$test_intrr' WHERE
	`test_id` = '$test_id'"; 
	$run_add_t_i_q = mysqli_query($conn, $add_t_i_q);

	if ($run_add_t_i_q) 
	{
		echo "
			<script>
					alert('Added Successfully !');
					location = 'setting.php?te-id=".$test_id."';
			</script>
		";
	}
	else
	{
		echo "<script>
					alert('Unable to Add !');
					location = 'setting.php?te-id=".$test_id."';
			</script>";
	}
}

// add custom theme
if (isset($_POST['save-theme'])) 
{
	$test_theme = $_POST['test-p-theme'];

	$add_t_i_q = "UPDATE `test-table` SET `test_theme` = '$test_theme' WHERE
	`test_id` = '$test_id'"; 
	$run_add_t_i_q = mysqli_query($conn, $add_t_i_q);

	if ($run_add_t_i_q) 
	{
		echo "
			<script>
					alert('Added Successfully !');
					location = 'setting.php?te-id=".$test_id."';
			</script>
		";
	}
	else
	{
		echo "<script>
					alert('Unable to Add !');
					location = 'setting.php?te-id=".$test_id."';
			</script>";
	}
}
// time limit
if (isset($_POST['save-t-l'])) 
{
	$time_rad_v = $_POST['time-limit-min'];
	$time_e_b_u = $_POST['enter-time-m'];


	if ($time_rad_v == "unlimited")
	{
		$time_e_b_u = 0;

		$insert_time_q = "UPDATE `test-table` SET `test_time_limit` = '$time_e_b_u' WHERE `test_id` = '$test_id'"; 
		$run_insert_time_q = mysqli_query($conn, $insert_time_q);

		if ($run_insert_time_q) 
		{
			echo "
				<script>
					alert('Updated Successfully !');
					location = 'setting.php?te-id=".$test_id."';
				</script>
			";
		}
		else
		{
			echo "<script>
					alert('Unable to Updated !');
					location = 'setting.php?te-id=".$test_id."';
				</script>
			";
		}
	}
	elseif ($time_rad_v == "enter-time-m") 
	{
		$insert_time_q = "UPDATE `test-table` SET `test_time_limit` = '$time_e_b_u' WHERE `test_id` = '$test_id'"; 
		$run_insert_time_q = mysqli_query($conn, $insert_time_q);

		if ($run_insert_time_q) 
		{
			echo "
				<script>
					alert('Updated Successfully !');
					location = 'setting.php?te-id=".$test_id."';
				</script>
			";
		}
		else
		{
			echo "<script>
					alert('Unable to Updated !');
					location = 'setting.php?te-id=".$test_id."';
				</script>
			";
		}
	}
}
// aditional settings
if (isset($_POST['a-s-btn'])) 
{
	$d_r_c_c_m = $_POST['d-r-c-c-m'];
	$d_c_p = $_POST['d-c-p'];
	$d_sel = $_POST['d-sel'];
	$rand_ques = $_POST['rand-ques'];
	$rand_opt = $_POST['rand-opt'];
	$downl_q_p = $_POST['download_q_p'];
	$at_t_e_display_res_f = $_POST['dis_re_a_t'];

	$up_a_s = "UPDATE `test-table` SET `d_right_click`= '$d_r_c_c_m', `d_copy_paste`= '$d_c_p', `d_selection`= '$d_sel', `rand_ques`= '$rand_ques', `rand_opt`= '$rand_opt', `download_q_p` = '$downl_q_p', `at_t_e_display_res` = '$at_t_e_display_res_f' WHERE `test_id` = '$test_id'";
	$run_up_a_s = mysqli_query($conn, $up_a_s);

	if ($run_up_a_s) 
	{
		echo "
			<script>
				alert('Updated Successfully !');
				location = 'setting.php?te-id=".$test_id."';
			</script>
		";
	}
	else
	{
		echo "<script>
				alert('Unable to Updated !');
				location = 'setting.php?te-id=".$test_id."';
			</script>
		";
	}
}
// update test password status & test password
if (isset($_POST['u-t-pass'])) 
{
	$c_p_s_t = $_POST['c-p-s-t'];
	$new_test_password = $_POST['new-test-password'];

	$up_t_s_a_p = "UPDATE `test-table` SET `test_password_status`= '$c_p_s_t', `test_password`= '$new_test_password' WHERE `test_id` = '$test_id'";
	$run_up_t_s_a_p = mysqli_query($conn, $up_t_s_a_p);

	if ($run_up_t_s_a_p) 
	{
		echo "
			<script>
				alert('Updated Successfully !');
				location = 'setting.php?te-id=".$test_id."';
			</script>
		";
	}
	else
	{
		echo "<script>
				alert('Unable to Updated !');
				location = 'setting.php?te-id=".$test_id."';
			</script>
		";
	}
	/*
	echo "
			<script>
				alert('Updated Successfully ".$c_p_s_t." ".$new_test_password." !');
			</script>
		";
	*/
}
?>