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
	<title>IMTIHAN</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Required meta tags Close-->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="image/logo/favicon.png">
    <link rel="shortcut" type="image/x-icon" href="image/logo/favicon.png">
    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
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

<div class="container">
	<div class="banner-pic">
		PIC
	</div>
	<div class="text-container">
		<div class="banner-head">Easily create tests for your class,<br>buisness or organisation.</div>
		<hr class="text-container-hr">
		<p class="banner-text-para">Distribute your tests online and get the rasults instantly.<br>IMTIHAN does all the grading for you
		</p>
		<div class="banner-button">
			<a href="dashboard/" class="banner-btn banner-btn-one">Biuld a Test</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="demo-test.php" class="banner-btn banner-btn-two">Try a Demo Test</a>
		</div>
	</div>

	<br><br>
	<hr class="hr-bw-container">

	<div class="sec-container">
		
		<h1 class="some-info">SIMPLE STEPS</h1>
		<div class="sec-container-box">
			<div class="direction-box">
				<span class="direc-h">Sign up for free.</span>
				<p class="direction-box-para">Simply You can create your test</p>
			</div>
			<div class="direction-box">
				<span class="direc-h">Adjust a few Setting.</span>
				<p class="direction-box-para">In a few click, You can completley custmize your test.</p>
			</div>

			<div class="direction-box">
				<span class="direc-h">Add Your Question.</span>
				<p class="direction-box-para">You can insert and  edit all your questions.</p>
			</div>

			<div class="direction-box">
				<span class="direc-h">Distribute the URL.</span>
				<p class="direction-box-para">Just share the URL to your students or testtakers.</p>
			</div>
		</div>
	</div>
</div>

<br><br><br>

<!-- FOOTER -->
<?php

include 'structure/footer.php';

?>
</body>
</html>