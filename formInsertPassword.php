<?php
	require 'autoload.php';
  use App\Core\RandomPassword;
  $suggested_password = new RandomPassword();
  $suggested_password = $suggested_password->getStringas();
		print ("<FORM METHOD=POST  ACTION='insert.php'>");
				print("Svetainė:  <INPUT REQUIRED maxlength='250' TYPE='text' NAME='loginName'>");
				print ("<br>Slaptažodis:  <INPUT REQUIRED TYPE='text' maxlength='1000' NAME='sitePassword' value='$suggested_password' > ");
				print (" <a href=formRandomPasswordSettings.php>Keisti atsitiktinio slaptažodžio nustatymus</a>");
				print ("<br> <INPUT TYPE='submit' VALUE='Kurti'>");
		print ("</FORM>");
		print ("<a href=listPasswords.php> Sąrasas </a>");
?>