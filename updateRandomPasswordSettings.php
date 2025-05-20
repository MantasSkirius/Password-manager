<?php
	require 'autoload.php';
	session_start();
	use App\Core\connectToDB;
	$conn = new connectToDB();
	$conn = $conn->getConnection();
  $lowercase_number = $_POST["lowercase_number"];
	$uppercase_number = $_POST["uppercase_number"];
	$special_number = $_POST["special_number"];
	$numbers_number = $_POST["numbers_number"];
	$user = $_SESSION['active_user'];
	$sql = "UPDATE users SET 
    lowercase_number = '$lowercase_number',
    uppercase_number = '$uppercase_number',
    special_number = '$special_number',
    numbers_number = '$numbers_number'
    WHERE name = '$user'";
	if ($conn->query($sql) == TRUE) {
			print ("Nustatymai atnaujinti<br>" );
			print ("<a href=formInsertPassword.php>Grįžti </a>");	
		}
?>