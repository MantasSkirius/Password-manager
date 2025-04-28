<?php
	require 'autoload.php';
	
  // include 'index.php';

use App\Core\Password;
use App\Services\FormValidation;
	$validatorius = new formValidation;
	print(var_dump($validatorius));
	print(var_dump($_POST));
	$loginName=$validatorius->testuotigautusduomenis($_POST["loginName"]);
	$sitePassword=$validatorius->testuotigautusduomenis($_POST["sitePassword"]);
	$password = new Password($loginName, $sitePassword);
?>