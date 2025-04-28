<?php
include "connect.php";

	$id=$_POST["id"];
	$site=$_POST["site"];
	$encrypted_password=$_POST["encrypted_password"];
	
	$sql=("UPDATE passwords SET site ='$title', encrypted_password '$encrypted_password' WHERE id=$id");
	if ($conn->query($sql) == TRUE) {
			print ("Atnaujintas: $id <br>" );
			print ("<a href=lostPasswords.php> Sarasas </a>");	
		}
		else
		{
			print("Klaida ");
		}
?>