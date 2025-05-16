<?php
	require 'autoload.php';
  use App\Core\RandomString;
  $suggested_password = new RandomString(15);
  $suggested_password = $suggested_password->getStringas();
		print ("<FORM METHOD=POST  ACTION='insert.php'>");
				print("Svetainė: <INPUT TYPE='text' NAME='loginName'>");
				print ("<br>Password: <INPUT TYPE='text' NAME='sitePassword' value='$suggested_password' > ");
				print ("<br> <INPUT TYPE='submit' VALUE='Kurti'>");
		print ("</FORM>");
		print ("<a href=listPasswords.php> Sąrasas </a>");
?>