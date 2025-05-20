<?php
	require 'autoload.php';
	use App\Core\connectToDB;

  session_start();
  $conn = new connectToDB();
  $conn = $conn->getConnection();
  $user = $_SESSION['active_user'];
  $sql = "SELECT * FROM users WHERE name = '$user'";
  $stmt = $conn->query($sql);
	$row = $stmt->fetch(\PDO::FETCH_ASSOC);
	$lowercase_number = $row['lowercase_number'];
	$uppercase_number = $row['uppercase_number'];
	$numbers_number = $row['numbers_number'];
	$specialChars_number = $row['special_number'];
	print ("<form method='POST' action='updateRandomPasswordSettings.php'>");
		print ("Mažųjų raidžių kiekis: <input type='number' value='$lowercase_number' name='lowercase_number' value='$'required><br>");
		print ("Didžiųjų raidžių kiekis: <input type='number' value='$uppercase_number' name='uppercase_number' required><br>");
		print ("Specialių simbolių kiekis: <input type='number' value='$specialChars_number' name='special_number' required><br>");
		print ("Skaičių kiekis: <input type='number' value='$numbers_number' name='numbers_number' required><br>");
		print ("<input type='submit' value='Atnaujinti nustatymus'>");
	print ("</form>");
	print ("<a href='formInsertPassword.php'>Grįžti</a>");
?>