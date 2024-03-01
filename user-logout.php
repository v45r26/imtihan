<?php
session_start();
if(isset($_GET['te-id']))
{
    $test_id = $_GET['te-id'];
}
session_unset();
session_destroy();
header("location: ex-tes.php?id=".$test_id);
exit;
?>