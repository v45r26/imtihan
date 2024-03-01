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

/* random chracter for question id */

$m=8;
$n=8;
$o=8;
function getName1($m) { 
  $characters1 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString1 = ''; 

  for ($i1 = 0; $i1 < $m; $i1++) { 
    $index1 = rand(0, strlen($characters1) - 1); 
    $randomString1 .= $characters1[$index1]; 
  } 

  return $randomString1; 
}

function getName2($n) { 
  $characters2 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString2 = ''; 

  for ($i2 = 0; $i2 < $n; $i2++) { 
    $index2 = rand(0, strlen($characters2) - 1); 
    $randomString2 .= $characters2[$index2]; 
  } 

  return $randomString2; 
}


function getName3($o) { 
  $characters3 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString3 = ''; 

  for ($i3 = 0; $i3 < $o; $i3++) { 
    $index3 = rand(0, strlen($characters3) - 1); 
    $randomString3 .= $characters3[$index3]; 
  } 

  return $randomString3; 
}

$_rn1 = getName1($m); 
$_rn2 = getName2($n); 
$_rn3 = getName3($o);

$q_id = $_rn1."-".$_rn2."-".$_rn3;

// adding question to test
// inserting mcq
if(isset($_POST['add-question-mcq']))
{
    $test_id = $_POST['test-id'];
    $question_title = $_POST['question-title'];
    $option_one = $_POST['option-1'];
    $option_two = $_POST['option-2'];
    $option_three = $_POST['option-3'];
    $option_four = $_POST['option-4'];
    $correct_option = $_POST['correct-option'];
    $point = $_POST['point-m'];

    if(empty($question_title) || empty($option_one) || empty($option_two) || empty($option_three) || empty($option_four) || empty($correct_option) || empty($point))
    {
        echo "<script>alert('Plese fill All the Fields');</script>";
        echo "<script>window.location = 'question_c.php?te-id=".$test_id."';</script>";
    }
    elseif ($correct_option == "S_C_O") 
    {
        echo "<script>alert('Plese Select Correct Option');</script>";
        echo "<script>window.location = 'question_c.php?te-id=".$test_id."';</script>";
    }
    else
    {
        $check_exist_test = "SELECT * FROM  `test-table` WHERE `test_id` = '$test_id'";
        $run_check_exist_test = mysqli_query($conn, $check_exist_test);
        
        if ($run_check_exist_test) 
        {
            $no_of_test = mysqli_num_rows($run_check_exist_test);

            if ($no_of_test > 1 || $no_of_test <= 0) 
            {
                echo "<script>alert('Wrong URL');location = '../dashboard';</script>";
            }
            else
            {
                // inserting question
                
                $question_insert = "INSERT INTO `question-table` (`sno`, `test_id`, `q_id`, `question-title`, `correct-option`, `point-marks`) VALUES (NULL, '$test_id','$q_id', '$question_title', '$correct_option' , '$point')";
                $question_insert_query = mysqli_query($conn, $question_insert);
                
                // option no for option table 
                $option_value_one = "option-1";
                $option_value_two = "option-2";
                $option_value_three = "option-3";
                $option_value_four = "option-4";

                // inserting option-1
                $insert_option_one = "INSERT INTO `option-table` (`sno`, `q_id`, `option_title`, `option_no`) VALUES (NULL, '$q_id', '$option_one', '$option_value_one')";
                $run_insert_option_one = mysqli_query($conn, $insert_option_one);       

                // inserting option-2
                $insert_option_two = "INSERT INTO `option-table` (`sno`, `q_id`, `option_title`, `option_no`) VALUES (NULL, '$q_id', '$option_two', '$option_value_two')";
                $run_insert_option_two = mysqli_query($conn, $insert_option_two);        

                // inserting option-3
                $insert_option_three ="INSERT INTO `option-table` (`sno`, `q_id`, `option_title`, `option_no`) VALUES (NULL, '$q_id', '$option_three', '$option_value_three')";
                $run_insert_option_three = mysqli_query($conn, $insert_option_three);        

                // inserting option-4
                $insert_option_four = "INSERT INTO `option-table` (`sno`, `q_id`, `option_title`, `option_no`) VALUES (NULL, '$q_id', '$option_four', '$option_value_four')";
                $run_insert_option_four = mysqli_query($conn, $insert_option_four);

                if($question_insert_query && $run_insert_option_one && $run_insert_option_two && $run_insert_option_three && $run_insert_option_four)
                {
                    echo "<script>alert('Inserted Successfully');</script>";
                    echo "<script>window.location = 'question_c.php?te-id=".$test_id."';</script>";
                }
                else
                {
                    echo "<script>alert('Unable to Insert Please try Again');</script>";
                    echo "<script>window.location = 'question_c.php?te-id=".$test_id."';</script>";
                }
            }
        }
    }
}
// inserting true false
elseif(isset($_POST['add-question-tf']))
{
    $test_id = $_POST['test-id'];
    $question_title = $_POST['question-title'];
    $option_one = $_POST['option-1'];
    $option_two = $_POST['option-2'];
    $correct_option = $_POST['correct-option'];
    $point = $_POST['point-m'];

    if(empty($question_title) || empty($option_one) || empty($option_two) || empty($correct_option) || empty($point))
    {
        echo "<script>alert('Plese fill All the Fields');</script>";
        echo "<script>window.location = 'question_c.php?te-id=".$test_id."';</script>";
    }
    elseif ($correct_option == "S_C_O") 
    {
        echo "<script>alert('Plese Select Correct Option');</script>";
        echo "<script>window.location = 'question_c.php?te-id=".$test_id."';</script>";
    }
    else
    {
        $check_exist_test = "SELECT * FROM  `test-table` WHERE `test_id` = '$test_id'";
        $run_check_exist_test = mysqli_query($conn, $check_exist_test);
        
        if ($run_check_exist_test) 
        {
            $no_of_test = mysqli_num_rows($run_check_exist_test);

            if ($no_of_test > 1 || $no_of_test <= 0) 
            {
                echo "<script>alert('Wrong URL');location = '../dashboard';</script>";
            }
            else
            {
                // inserting question
                
                $question_insert = "INSERT INTO `question-table` (`sno`, `test_id`, `q_id`, `question-title`, `correct-option`, `point-marks`) VALUES (NULL, '$test_id','$q_id', '$question_title', '$correct_option' , '$point')";
                $question_insert_query = mysqli_query($conn, $question_insert);
                
                // option no for option table 
                $option_value_one = "option-1";
                $option_value_two = "option-2";

                // inserting option-1
                $insert_option_one = "INSERT INTO `option-table` (`sno`, `q_id`, `option_title`, `option_no`) VALUES (NULL, '$q_id', '$option_one', '$option_value_one')";
                $run_insert_option_one = mysqli_query($conn, $insert_option_one);       

                // inserting option-2
                $insert_option_two = "INSERT INTO `option-table` (`sno`, `q_id`, `option_title`, `option_no`) VALUES (NULL, '$q_id', '$option_two', '$option_value_two')";
                $run_insert_option_two = mysqli_query($conn, $insert_option_two);  

                if($question_insert_query && $run_insert_option_one && $run_insert_option_two)
                {
                    echo "<script>alert('Inserted Successfully');</script>";
                    echo "<script>window.location = 'question_c.php?te-id=".$test_id."';</script>";
                }
                else
                {
                    echo "<script>alert('Unable to Insert Please try Again');</script>";
                    echo "<script>window.location = 'question_c.php?te-id=".$test_id."';</script>";
                }
            }
        }
    }
}
else
{
    $failed = "Wrong URL";
    echo "<script>alert('".$failed."');</script>";
    echo "<script>window.location = 'question_c.php?te-id=".$test_id."';</script>";
}
?>