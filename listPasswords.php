<?php
include "index.php";
use App\Core\connectToDB;
// session_start();
print ("<a href=FormInsertPassword.php> Naujas irasas </a> <br>");

	$sql="SELECT * FROM passwords WHERE user_name = '".$_SESSION['active_user']."'";
	$conn = new connectToDB();
	$conn = $conn->getConnection();
	$data = $conn->query($sql)->fetchAll();
	
	//Surenku visus slaptažodžius, kurie priklauso vartotojui ir jų skaičių:
	$sql_kiek=("SELECT count(id) as kiekis FROM passwords WHERE user_name = '".$_SESSION['active_user']."'");
	$count = $conn->query("$sql_kiek")->fetchColumn();
	print("Slaptažodžių sistemoje: ".$count);
	print("<br>");
	echo "id | data | svetainė | slaptažodis | <br>";
	$key = 	$_SESSION['key'];
	foreach ($data as $row) {
		echo $row['id']." | "; 
		echo $row['date']." | ";
	  echo $row['site']." | ";
		echo openssl_decrypt($row['encrypted_password'], 'AES-256-ECB', $key, 0)." | ";
	  $id=$row['id'];
	  print ("<a href=removePassword.php?id=$id> Trinti </a>"." | ");
	  print ("<a href=editPassword.php?id=$id> Keisti </a>" . "<br>");
  }
?>