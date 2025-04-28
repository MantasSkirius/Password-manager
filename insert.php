<?php
	require 'autoload.php';
  // include 'index.php';
	use App\Services\FormValidation;
	global $conn, $user;
	print($conn." ".$user);
	$validatorius = new formValidation;
	print(var_dump($validatorius));
	print(var_dump($_POST));
	$loginName=$validatorius->testuotigautusduomenis($_POST["loginName"]);
	$sitePassword=$validatorius->testuotigautusduomenis($_POST["sitePassword"]);
	$date = date("Y-m-d H:i:s");
	print ("<br>".$loginName." ".$sitePassword." ".$date);

	// $sql="INSERT INTO passwords (, author) VALUES ('".$title."','".$author."')";
?>