<?php
	session_start();
	require 'autoload.php';
	use App\Core\connectToDB;
	$conn = new connectToDB();
	$conn = $conn->getConnection();

	$id=$_GET["id"];
	$sql="SELECT * FROM passwords where id=$id";
	$data = $conn->query($sql)->fetchAll();
  
	foreach ($data as $row) {
	$id=$row['id'];
	$site=$row['site'];
	$encrypted_password=$row['encrypted_password'];
	$encrypted_password=openssl_decrypt($encrypted_password, 'AES-256-ECB', $_SESSION['key'], 0);
		print ("<FORM METHOD=POST  ACTION='updatePassword.php'>");
				print("<INPUT TYPE='hidden' NAME='id' value='$id'>");
				print("Title: <INPUT TYPE='text' NAME='title' value='$site'>");
				print ("<br>Author: <INPUT TYPE='text' NAME='author' value='$encrypted_password' > ");
				print ("<br> <INPUT TYPE='submit' VALUE='Keisti'>");
				print 	("<INPUT TYPE='reset' VALUE='Atsaukti'>");
		print ("</FORM>");
		print ("<a href=listPasswords.php> Sarasas </a>");
 	}
?>