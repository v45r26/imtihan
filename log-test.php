<?php

include'dbconnect.php';

if(isset($_GET['t-id']))
{
    if(!$_GET['t-id'])
    {
        echo "<script>window.location = 'error.html'</script>";
    }
    else
    {
        $test_id = $_GET['t-id'];
        
        // checking test is exist or not
        $test_id_quary = "SELECT * FROM `test-table` WHERE `test_id` = '$test_id'";
        $run_test_id_quary = mysqli_query($conn, $test_id_quary);
        $Num_Exist_Test_Rows = mysqli_num_rows($run_test_id_quary); 

        if($Num_Exist_Test_Rows == 1)
        {
            while($for_test_title = mysqli_fetch_assoc($run_test_id_quary))
            {
                $test_title = $for_test_title['test_title'];
                $test_stat = $for_test_title['test_status'];
                $test_password_stat = $for_test_title['test_password_status'];
                $test_passw_db = $for_test_title['test_password'];
            }
            
        }
        else
        {
            echo "<script>window.location = 'error.html'</script>";
        }
    }
}
if(isset($_POST['w-pass-log']))
{
    $user_name = $_POST['user-name'];
    $t_pass = $_POST['t-password'];

    if ($user_name == "" || empty($user_name) || $t_pass == "" || empty($t_pass)) 
    {
        echo "<script>alert('Please Fill All The Field');</script>";
    }
    else
    {
        if ($t_pass == $test_passw_db) 
        {
            session_start();
            $_SESSION['user-logged'] = true;
            $_SESSION['user-name'] = $user_name;
            header("location: ex-tes.php?id=".$test_id."");
        }
    }
                
}
elseif (isset($_POST['wo-pass-log']))
{
    $user_name = $_POST['user-name'];
    if ($user_name == "" || empty($user_name)) 
    {
        echo "<script>alert('Please Fill All The Field');</script>";
    }
    else
    {
        session_start();
        $_SESSION['user-logged'] = true;
        $_SESSION['user-name'] = $user_name;
        header("location: ex-tes.php?id=".$test_id."");
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>IMTIHAN - <?php echo $test_title; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Required meta tags Close-->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="image/logo/favicon.png">
    <link rel="shortcut" type="image/x-icon" href="image/logo/favicon.png">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/log-test-page.css">

</head>
<body>

<h1>B_O_L['Best_Of_Luck']</h1>
<h1>A_T_B['All_The_Best']</h1>
<div class="container">
<?php

if ($test_stat == "open" || $test_stat == "Open") 
{
    if ($test_password_stat == "Yes" || $test_password_stat == "yes") 
    {
        echo '
    <form method="post">
        <div class="inp-form-cont-group">
            <input type="text" class="inp-form-cont" name="user-name" placeholder="Enter Your Name...">
        </div>
        <div class="inp-form-cont-group">
            <input type="passeord" class="inp-form-cont" name="t-password" placeholder="Password...">
        </div>
        <button type="Submit" class="log-btn" name="w-pass-log">Login</button>
    </form>
        ';   
    }
    elseif($test_password_stat == "None" || $test_password_stat == "none")
    {
        echo '
    <form method="post">
        <div class="inp-form-cont-group">
            <input type="text" class="inp-form-cont" name="user-name" placeholder="Enter Your Name...">
        </div>
        <button type="Submit" class="log-btn" name="wo-pass-log">Login</button>
    </form>
        ';
    }
}
elseif ($test_stat == "close" || $test_stat == "Close") 
{
    echo '<h1 align="center">TEST not Started Yet !</h1>';
}
?>  
</div>
</body>
</html>