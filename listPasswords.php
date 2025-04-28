<?php
include "index.php";

print ("<a href=FormInsertPassword.php> Naujas irasas </a> <br>");
	$sql="SELECT * FROM passwords";
	global $conn;	
	$data = $conn->query($sql)->fetchAll();
	
	//papildoma Select uzklausa gaunanti eiluciu (irasu) skaiciu lentelele
	$sql_kiek=("SELECT count(id) as kiekis FROM passwords");
	$count = $conn->query("$sql_kiek")->fetchColumn();
		print("Rasta eiluciu: ".$count);
		print("<br><br>");
	

	//isvedimas
	 foreach ($data as $row) {
	  echo $row['id']." ";
	  echo $row['author']." ";
	  echo $row['title']." ";
	  $id=$row['id'];
	  print ("<a href=remove.php?id=$id> Trinti </a> ");
	  print ("<a href=edit.php?id=$id> Keisti </a>" . "<br>");
  }
 
?>