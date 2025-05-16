<?php
	require 'autoload.php';
use App\Models\Password;
use App\Services\FormValidation;
	$validatorius = new formValidation;
	$loginName=$validatorius->testuotigautusduomenis($_POST["loginName"]);
	$sitePassword=$validatorius->testuotigautusduomenis($_POST["sitePassword"]);
	$password = new Password($loginName, $sitePassword);
?>