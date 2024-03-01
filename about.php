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
	<title>IMTIHAN - About Us</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Required meta tags Close-->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="image/logo/favicon.png">
    <link rel="shortcut" type="image/x-icon" href="image/logo/favicon.png">
    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/about.css">	
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<!-- FontAwesome -->
	<!-- <link rel="stylesheet" href="ICON/fontawesome-free-5.13.1-web/css/all.css"> -->
	<!-- Jab online hoga tab ke liye --> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<!-- HEADER -->
<!-- HEADER -->
<?php

include 'structure/header.php';

?>

<br><br><br><br><br>

<div class="container">
  <noscript>
	<h3>About Us</h3>
	<p>
		Our Goal to provide all features free to all User.
	</p>
  </noscript>

  <div class="txt">
    imtihan.in
  </div>

</div>

<noscript>
  IMTIHAN / QUIZALS - Testsite

signup             'Done!'
login            'Done!'
logout             'Done!'
profile 
  ->  `update`           'Done!'
  ->  `Password Change`  'Not started'
  ->  `user delete`      'Not started'

test 
  ->  `create`         'Done!'
  ->  `edit`             'Done!'
  ->  `delete`       'Done!'

dashboard
  ->  `question view`       'Done!'
  ->  `question create`     'Done!'
  ->  `question delete`     'Done!'
  ->  `question edit`       'Done!'
  ->  `Share(copy) URL`     'Done! but not copy'
  ->  `test password change`  'Done!' 
  ->  `Result`        'Done!'
  ->  `downoad result`    'Done!'
  ->  `download-question-paper` 'DONE! but not completly'

test-taker
  ->  `test login`     'Done!'
  ->  `test logout`    'Done!'
  ->  `test page`      'Done!'
  ->  `timmer`       'Done!'
  ->  `security`
      ->  `disable selection`           'Done!'
      ->  `disable right click context menu`  'Done!'
      ->  `disable copy paste`          'Done!'
      ->  `radomize question`         'Done!' 
      ->  `radomize option`           'Done!'
  ->  `Mark sheet page`             'Done!'
  ->  `download-question-paper`         'DONE! but not completly'

->  `privacy_policy` 
->  `faqs`
->  `about us`
->  `pricing`-[MODIFY Karna Hai]

AND THEME designing


/****/ Responsive

  == home page



<!-- future content of setting page -->

<div class="container">
  Show Custom Msg when Pass or Fail
  <input type="text" name=""  oncopy="alert('Copyied');return false;" onpaste="alert('Pasted Successfully !')">
</div>

<div class="container">
  What should test takers enter to identify themselves?<br>
  This text appears above the field where the test taker enters their identifier. It should tell them what to enter.<br>
  Examples: "Enter your name", "Enter your student ID", or "Please enter your company email address"
</div>

<div class="container">
  Anyone who enter by ID/EMail ID /ONLY PASSWord / NOthing(Anyone)
</div>

<div class="container">
  <pre>
  Some features from me
    -> Download Question Paper After Test
    -> Download Result/Report Card
  </pre>

</div>
</noscript>

<br><br><br><br><br><br><br><br><br><br>
<!-- FOOTER -->
<!-- FOOTER -->
<?php

include 'structure/footer.php';

?>
</body>
</html>