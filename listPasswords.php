<?php
include "connect.php";

print ("<a href=form.html> Naujas irasas </a> <br>");

	$sql="SELECT * FROM passwords";
	$data = $conn->query($sql)->fetchAll();
	
	
	//papildoma Select uzklausa gaunanti eiluciu (irasu) skaiciu lentelele
	$sql_kiek=("SELECT count(id) as kiekis FROM book");
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