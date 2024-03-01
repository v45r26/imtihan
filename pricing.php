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
	<title>IMTIHAN - PRICING</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Required meta tags Close-->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="image/logo/favicon.png">
    <link rel="shortcut" type="image/x-icon" href="image/logo/favicon.png">
    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/pricing.css">
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
	<div class="pric-cont">
		<p>
			<i class="fas fa-check"></i>ALL Features are Free<br>
			<i class="fas fa-check"></i>No Test Limit<br>
			<i class="fas fa-check"></i>No Attempt Limit<br>
			<i class="fas fa-check"></i>Secure
		</p>
		<div class="btn-p">FREE</div>
	</div>

	<div class="pric-cont fl-right">
		<br><br><br>
		<div class="btn-p" id="click-btn">DONATE</div>
	</div>
</div>
	
	<div class="openDiv" id="openDiv">

		<span class="close close-btn">
			<i class="fas fa-times"></i>
		</span>

		<br><br>
		<div class="payment-data-cont">
			<div class="payment-data">
				UPI ID : 6363636363@upi
			</div>
			<div class="payment-data">
				Paytm no. : 6363636363
			</div>
			<div class="payment-data">
				Phone Pe no. : 6363636363
			</div>
			<div class="payment-data">
				<table>
					<tr>
						<td>Bank</td>
						<td>:&nbsp; NAMO BANK</td>
					</tr>
					<tr>
						<td>A/C No.</td>
						<td>:&nbsp; 1895-528-528-525</td>
					</tr>
					<tr>
						<td>IFSC Code</td>
						<td>:&nbsp; NAMO2014</td>
					</tr>
					<tr>
						<td>A/C Holder &nbsp;</td>
						<td>:&nbsp; Narendra Modi</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- FOOTER -->
<?php

include 'structure/footer.php';

?>

<script type="text/javascript">
	var click_btn = document.getElementById('click-btn');
	var openDiv = document.getElementById('openDiv');
	var span = document.getElementsByClassName("close")[0];

	click_btn.onclick = function()  
	{
		openDiv.style.display = "block";
	}

	function close_div() 
	{
		openDiv.style.display = "none";
	}

	span.onclick = function()  
	{
		close_div();
	}
</script>

</body>
</html>