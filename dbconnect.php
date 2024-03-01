<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "imtihan-db";

$conn = mysqli_connect($server , $username , $password , $db);

if (!$conn) 
{
	die("Failed to connect due to this error --->" .mysql_connect_error());
} 
else 
{
	//echo "Connected";
}


?>