<?php
include "index.php";
use App\Core\connectToDB;
session_start();
print ("<a href=FormInsertPassword.php> Naujas irasas </a> <br>");

	$sql="SELECT * FROM passwords WHERE user_name = '".$_SESSION['active_user']."'";
	$conn = new connectToDB();
	$conn = $conn->getConnection();
	$data = $conn->query($sql)->fetchAll();
	
	//papildoma Select uzklausa gaunanti eiluciu (irasu) skaiciu lentelele
	$sql_kiek=("SELECT count(id) as kiekis FROM passwords");
	$count = $conn->query("$sql_kiek")->fetchColumn();
		print("Rasta eiluciu: ".$count);
		print("<br><br>");
	$key = 	$_SESSION['key'];
	//isvedimas
	 foreach ($data as $row) {
	  echo $row['id']." ";
	  echo $row['user_name']." ";
	  echo $row['site']." ";
	  echo $row['date']." ";
		echo openssl_decrypt($row['encrypted_password'], 'AES-256-ECB', $key, 0)." ";
	  $id=$row['id'];
	  print ("<a href=remove.php?id=$id> Trinti </a> ");
	  print ("<a href=edit.php?id=$id> Keisti </a>" . "<br>");
  }
?>