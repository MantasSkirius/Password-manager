<?php
	require 'autoload.php';
	session_start();
	use App\Core\connectToDB;
	$conn = new connectToDB();
	$conn = $conn->getConnection();
	$key = $_SESSION['key'];
	$id=$_POST["id"];
	$site=$_POST["loginName"];
	$new_password=$_POST["new_password"];
	$encrypted_password = openssl_encrypt($new_password, 'AES-256-ECB', $key, 0);
	$sql=("UPDATE passwords SET site ='$site', encrypted_password = '$encrypted_password' WHERE id=$id");
	if ($conn->query($sql) == TRUE) {
			print ("Atnaujintas: $id <br>" );
			print ("<a href=listPasswords.php> Sarasas </a>");	
		}
		else
		{
			print("Klaida ");
		}
?>