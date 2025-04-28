<?php
require 'autoload.php';
use App\Core\connectToDB;
$conn = new connectToDB();
$conn = $conn->getConnection();
$id=$_GET["id"];
print ($id." ");
$sql="DELETE FROM passwords WHERE id=$id";
if ($conn->query($sql) == TRUE) {
	print ( "Irasas istrintas");
	print ("<a href=listPasswords.php> List </a>");
	} else {
		print ("klaida");
	}
?>