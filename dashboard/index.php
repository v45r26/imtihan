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

$up_al = false;
$dl_al = false;

// geting no of test

$select_test_query = "SELECT * FROM `test-table` WHERE `admin_id` = '$admin_id'";
$run_select_test_query = mysqli_query($conn, $select_test_query);

$no_of_test = mysqli_num_rows($run_select_test_query);


// delete query
if (isset($_GET['del-id'])) 
{
	$del_test_id = $_GET['del-id'];
		
	$delete_test = "DELETE FROM `test-table` WHERE `test-table`.`test_id` = '$del_test_id'";
	$run_delete_test = mysqli_query($conn, $delete_test);

	// abhi question answer delete karene ka code baki hai
	if ($run_delete_test) 
	{
		$dl_al = true;
	}
	else
	{
		
		echo"<script>
				alert('Unable to Delete');
				location = 'index.php';
			</script>";
	}
}

// edit query

if (isset($_POST['update_te_'])) 
{
	
	$edit_test_id = $_POST['update_te_id'];
	$edit_test_title = $_POST['update_te_title'];
	$edit_test_status = $_POST['updete_te_status'];

	if (!empty($edit_test_id) || !empty($edit_test_title) || !empty($edit_test_status)) 
	{
		$update_query = "UPDATE `test-table` SET `test_title` = '$edit_test_title', `test_status` = '$edit_test_status' WHERE `test-table`.`test_id` = '$edit_test_id'";
		$run_update_query = mysqli_query($conn, $update_query);

		if ($run_update_query) 
		{
			$up_al = true;
			//echo '<div id="snackbar" class="show">Updated Successfully</div>';
			echo "<script>
					//alert('Updated Successfully !');
					//location = 'index.php';
				</script>";
		}
		else
		{
			echo "<script>
					alert('Unable to UPDATE !');
					location = 'index.php';
				</script>";
		}
	}

	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>IMTIHAN - Dashboard</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Required meta tags Close-->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../image/logo/favicon.png">
    <link rel="shortcut" type="image/x-icon" href="../image/logo/favicon.png">
    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/dash-it.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">	
	<!-- FontAwesome -->
	<!-- <link rel="stylesheet" href="../ICON/fontawesome-free-5.13.1-web/css/all.css"> -->
	<!-- Jab online hoga tab ke liye --> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- data table -->
	<link rel="stylesheet" type="text/css" href="../DATATABLE-PLUGIN/dataTables.css">
	<style type="text/css">
#snackbar 
{
  	visibility:hidden;
  	min-width: 250px;
  	margin-left: -125px;
  	background-color: #333;
  	color: #fff;
  	text-align: center;
  	border-radius: 2px;
  	padding: 16px;
  	position: fixed;
  	z-index: 1000;
  	left: 50%;
  	bottom: 30px;
  	font-size: 17px;
}
#snackbar.show 
{
  	visibility: visible;
  	-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  	animation: fadein 0.5s, fadeout 0.5s 2.5s;
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

<div class="create-container">
	<!-- Trigger/Open The Modal -->
	<button id="myBtn" class="add-btn-modal" title="Create Test">
		<i class="fas fa-plus"></i>
	</button>

	<div class="no-of-test">
		No. of Test<br><span class="b-no"><?php echo $no_of_test; ?></span>		
	</div>
</div>

<div class="container">


	<div class="table-container">
		<table class="table test-table" id="myTable" name="myTable">
			<thead>
				<br>
				<tr>
					<th scope="col" width="8%">Sl No.</th>
					<th scope="col" width="">TITLE</th>
					<th scope="col" width="10%">STATUS</th><!-- Active/deactivate or open/close for test taker -->
					<th scope="col" width="17%">PASSWORD STATUS</th>
          <th scope="col" width="12%">SHARE LINK</th>
					<th scope="col" width="10%">ACTION</th><!-- Delete Edit -->
				</tr>
			</thead>
			<tbody>
<?php

$s_l_n_o = 0;

if ($run_select_test_query) 
{
	while($fetch_test = mysqli_fetch_array($run_select_test_query))
	{
		$s_l_n_o++;
		$test_id_db = $fetch_test['test_id'];
		$test_title_db = $fetch_test['test_title'];
		$test_status_db = $fetch_test['test_status'];
		$test_status_password_db = $fetch_test['test_password_status'];

    if ($test_status_db == "open") 
    {
      $test_status_db = "OPEN";
    }
    elseif ($test_status_db == "close") 
    {
      $test_status_db = "CLOSE";
    }
    if ($test_status_password_db == "yes" || $test_status_password_db == "Yes") 
    {
      $test_status_password_db = "YES";
    }
    elseif ($test_status_password_db == "none" || $test_status_password_db == "None") 
    {
      $test_status_password_db = "NONE";
    }


?>
				<tr>
					<td><?php echo $s_l_n_o; ?></td>
					<td><a href="test-builder.php?te-id=<?php echo $test_id_db; ?>"><?php echo $test_title_db; ?></a>
					</td>
					<td><?php echo $test_status_db; ?></td>
					<td><?php echo $test_status_password_db; ?></td>
          <td>
            <a href="../ex-tes.php?id=<?php echo $test_id_db; ?>" target="_blank">URL</a>
          </td>
					<td style="text-align: center;">
						<i class="delete fas fa-trash-alt font-icon" id="<?php echo $test_id_db; ?>"></i>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="edit fas fa-edit font-icon" id="<?php echo $test_id_db; ?>"></i>
					</td>
				</tr>
<?php
	}
}
?>
			</tbody>
		</table>
	</div>
</div>
<br><br><br>
<!--
<div class="container">
	<fieldset>
		<legend>FORM</legend>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</fieldset>
</div>
-->
<?php

if ($up_al) 
{
	echo '<div id="snackbar" class="show">Updated Successfully</div>';
	echo '
		<input id="counter" value="3" type="hidden">
    	<script>
        	setInterval(function() {
            	var div = document.getElementById("counter");
            	var count = div.value - 1;
            	div.value = count;
            	if (count <= 0) {
                window.location.replace("../dashboard");
            	}
        	}, 1000);
    	</script>';
}

if ($dl_al) 
{
	echo '<div id="snackbar" class="show">Deleted Successfully</div>';
	echo '
		<input id="counter" value="5" type="hidden">
    	<script>
        	setInterval(function() {
            	var div = document.getElementById("counter");
            	var count = div.value - 1;
            	div.value = count;
            	if (count <= 0) {
                window.location.replace("../dashboard");
            	}
        	}, 1000);
    	</script>';
}


?>
<!-- edit-modal -->
<div id="myEditModal" class="modal">
  		<!-- Modal content -->
  		<div class="modal-content">
    		<span class="Eclose" style="float: right;"><i class="fas fa-times"></i></span>

    		<div>
    			<form class="form-c-t" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    				<input type="hidden" name="update_te_id" id="test_title_edit_id_f">
    				
    				<input type="text" class="text-c-t" name="update_te_title" id="test_title_edit_f" required spellcheck="false">
    				    				
    					<div class="status-cont">
    						<span class="status-c">
    							Status :&nbsp;&nbsp;<span id="test_status_edit_f"></span>
    							<input type="hidden" id="hid_status" name="updete_te_status">
    							<br><br>
    						Change Status :</span>
    						&nbsp;&nbsp;
    						<input type="radio" class="t-s-1" id="t-s-3" name="updete_te_status" value="open">
    						<label for="t-s-3" class="rad-status-1">
    							Open
    						</label>
    						&nbsp;&nbsp;
    						<input type="radio" class="t-s-2" id="t-s-4" name="updete_te_status" value="close">
    						<label for="t-s-4" class="rad-status-2">
    							Close
    						</label>
    					</div>
    					<p class="imp-info">To Change Password Status and Password Go to in setting of test and change according to your choice</p>
    					<div class="t-submit-btn">
    						<button type="submit" class="submit-c-t" name="update_te_">UPDATE</button>
    					</div>
    			</form>
    		</div>

    	</div>
</div>


<!-- create test The Modal -->
	<div id="myModal" class="modal">
  		<!-- Modal content -->
  		<div class="modal-content">
    		<span class="close"><i class="fas fa-times"></i></span>
    		
    		<form action="test-creater.php" method="post" class="form-c-t" name="myCreateTestForm" onsubmit="return validateform()">
    			
    			<input type="text" class="text-c-t" id="test_title" name="test_title" placeholder="Test-Title" required spellcheck="false">
    			<div class="status-cont">
    				<span class="status-c">Status :</span>
    				&nbsp;&nbsp;
    				<input type="radio" class="t-s-1" id="t-s-1" name="test_status" value="Open" checked>
    				<label for="t-s-1" class="rad-status-1">
    					Open
    				</label>
    				&nbsp;&nbsp;
    				<input type="radio" class="t-s-2" id="t-s-2" name="test_status" value="Close">
    				<label for="t-s-2" class="rad-status-2">
    					Close
    				</label>
    			</div>

    			<div class="status-cont">
    				<span class="status-c">Password :</span>
    				&nbsp;&nbsp;
    				<input type="radio" class="t-s-1" id="t-p-n" name="test_password_satus" value="None" checked>
    				<label for="t-p-n" class="rad-status-1">
    					No
    				</label>
    				<input type="hidden" name="test_password_v" value="010010001none">
    				&nbsp;&nbsp;
    				<input type="radio" class="t-s-2" id="t-p-y" name="test_password_satus" value="Yes">
    				<label for="t-p-y" class="rad-status-2">
    					Yes
    				</label><br>
    				<input type="text" name="test_password_v" class="test_password_v" id="toogle_area_pass" placeholder="Password" required disabled spellcheck="false">
    			</div>

    			<div class="t-submit-btn">
    				<button type="submit" class="submit-c-t">CREATE</button>
    			</div>

    		</form>
  		</div>
	</div>

<br>
<!-- FOOTER -->
<?php

include 'dash-footer.php';

?>

<!-- create modal script -->
<script>
	// Get the modal
	var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	btn.onclick = function() 
	{
  		modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() 
	{
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	/*window.onclick = function(even) 
	{
  		if (even.target === modal) 
  		{
  			modal.style.display = "none";
  		}
  	}*/
</script>
<!-- Password toggle script -->
<script>
	document.getElementById('t-p-y').addEventListener('change',function() 
	{
		if (document.getElementById('t-p-y').checked)
		{
			document.getElementById('toogle_area_pass').removeAttribute("disabled", "false");
			document.getElementById('toogle_area_pass').focus();
		}
	});

	document.getElementById('t-p-n').addEventListener('change',function() 
	{
		if (document.getElementById('t-p-n').checked)
		{
			document.getElementById('toogle_area_pass').setAttribute("disabled", "true");
		}
	});
</script>
<script type="text/javascript">
	function validateform()
	{
    	var c_test_title = document.getElementById("test_title").value;

    	if(c_test_title == null || c_test_title == "") 
    	{
       		alert("Plese fill Test Title field");
        	return false;
    	}	
	}
</script>



<!-- Bootstrap JS -->
<script src="../bootstrap-4.5.3-dist/jquery/jquery.slim.min.js"></script>
<script src="../DATATABLE-PLUGIN/dataTables.js"></script>
<script>
      $(document).ready( function () {
      $('#myTable').DataTable();
      } );
</script>
<script>
  var x = document.getElementById("snackbar");
  setTimeout(
    function()
    {
      x.className = x.className.replace("show", ""); 
    }, 
    3000);

</script>
<script type="text/javascript">
	// tooggle edit 
	var edmodal = document.getElementById("myEditModal");
	//var ebtn = document.getElementById("tara");
	var espan = document.getElementsByClassName("Eclose")[0];
		espan.onclick = function() 
		{
			edmodal.style.display = "none";
		}
		window.onclick = function(event) 
		{
  			if (event.target === edmodal || event.target === modal) 
  			{
  				edmodal.style.display = "none";
  				modal.style.display = "none";
  			}
  		}
	// edit-script
	edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) =>
    {
        element.addEventListener("click", (e) =>
        {
          	tr = e.target.parentNode.parentNode;

          	test_title_id_edits = e.target.id;

          	test_title_edits = tr.getElementsByTagName("td")[1].innerText;

          	test_status_edits = tr.getElementsByTagName("td")[2].innerText;

          	//console.log(test_title_id_edits, test_title_edits, test_status_edits);
          	
          	test_title_edit_f.value = test_title_edits;
          	
          	test_status_edit_f.innerText = test_status_edits;

          	hid_status.value = test_status_edits;
          	
          	test_title_edit_id_f.value = test_title_id_edits;
          	
          	edmodal.style.display = "block";
        })
    })
</script>
<script type="text/javascript">
	deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) =>
    {
    	element.addEventListener("click", (e) =>
        {
        	//console.log("delete" , );
          
          	sno = e.target.id;

          	if(confirm("Are you Sure want to Delete!"))
          	{
            	//console.log("Yes "+sno);
            	window.location =  `index.php?del-id=${sno}`;
          	}
          	else
          	{
            	//console.log("No");
          	}
        })
    })
</script>
</body>
</html>