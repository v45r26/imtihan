<?php
session_start();

if(!isset($_SESSION['loggedin_it']) || $_SESSION['loggedin_it'] != true)
{
  
}
else
{
//echo "<br><br><br><br>";
	$admin_user_name = $_SESSION['admin_user_name'];
	$admin_id = $_SESSION['admin_id'];
}

include 'dbconnect.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>IMTIHAN - DEMO TEST</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Required meta tags Close-->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="image/logo/favicon.png">
    <link rel="shortcut" type="image/x-icon" href="image/logo/favicon.png">
    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/demo-test.css">	
    <link rel="stylesheet" type="text/css" href="css/footer.css">
	<!-- FontAwesome -->
	<!-- <link rel="stylesheet" href="ICON/fontawesome-free-5.13.1-web/css/all.css"> -->
	<!-- Jab online hoga tab ke liye --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
</head>
<body>
<!-- HEADER -->
<?php

include 'structure/header.php';

?>

<br><br><br><br><br>
    <div class="question-container">
        <span class="s-no">1</span>
        <span class="m-point">1 Point</span>
        <input type="hidden" name="question-id[1]" value="RoAlH6OA-MIa4meaw-Y2BeIxFx">
        <div class="question-box">
            <p>Which one of the following river flows between Vindhyan and Satpura ranges ?</p>
        </div>
        
        <label class="option-box" for="9-Narmada">
            <input class="option-rad" type="radio" name="checked-option[1]" id="9-Narmada" value="option-1">
            Narmada
        </label>
                
        <label class="option-box" for="12-Netravati">
            <input class="option-rad" type="radio" name="checked-option[1]" id="12-Netravati" value="option-4">
            Netravati
        </label>
                
        <label class="option-box" for="10-Mahanadi">
            <input class="option-rad" type="radio" name="checked-option[1]" id="10-Mahanadi" value="option-2">
            Mahanadi
        </label>
                
        <label class="option-box" for="11-Son">
            <input class="option-rad" type="radio" name="checked-option[1]" id="11-Son" value="option-3">
            Son
        </label>
                
        <br>
    </div>
    <div class="question-container">
        <span class="s-no">2</span>
        <span class="m-point">1 Point</span>
        <input type="hidden" name="question-id[2]" value="xDc2GoAV-cP3lDN22-n7OGLSiX">
        <div class="question-box">
            <p>The Central Rice Research Station is situated in?</p>
        </div>
        
        <label class="option-box" for="15-Bangalore">
            <input class="option-rad" type="radio" name="checked-option[2]" id="15-Bangalore" value="option-3">
            Bangalore
        </label>
                
        <label class="option-box" for="13-Chennai ">
            <input class="option-rad" type="radio" name="checked-option[2]" id="13-Chennai " value="option-1">
            Chennai 
        </label>
                
        <label class="option-box" for="16-Quilon">
            <input class="option-rad" type="radio" name="checked-option[2]" id="16-Quilon" value="option-4">
            Quilon
        </label>
                
        <label class="option-box" for="14-Cuttack">
            <input class="option-rad" type="radio" name="checked-option[2]" id="14-Cuttack" value="option-2">
            Cuttack
        </label>
        <br>
    </div>
                
        
    <div class="sub-btn-box">
       	<button type="submit" class="submit-btn" id="submit">SUBMIT</button>
    </div>
    <br><br>

<script type="text/javascript">
	var sub_c = document.getElementById('submit');

	sub_c.onclick = function () 
	{
		alert('Sorry :( It Cant Submit ')
	}
</script>

<!-- FOOTER -->
<?php

include 'structure/footer.php';

?>
</body>
</html>