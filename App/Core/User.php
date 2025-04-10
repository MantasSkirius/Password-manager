<?php
namespace App\Core;
include "DBconfig.php";
use PDO;

class User {
  protected $name;
  protected $password;
  
  public function __construct($name, $password) {
    $this->name = $name;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
    $this->saveToDB();
  }

  private function saveToDB(){
    // global $address, $user, $pass, $database;
    // $conn = new PDO("mysql:host=$address;dbname=$database", $user, $pass);
    $address="localhost";
    $user= "root";
    $pass= "";
    $database="passwordmanagerdb";
    $conn = new PDO("mysql:host=$address;dbname=$database", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $name=$this->name;
    $password=$this->password;
    $sql="INSERT INTO users (name, password) VALUES ('".$name."','".$password."')";
    if ($conn->query($sql) == TRUE) {
	  	print ("Naujas irasas sukurtas");
	  	// print ("<a href=list.php> Sarasas </a>");
  	} else {
	  	print ("Klaida");
	  }
  }
}
?>