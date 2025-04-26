<?php
namespace App\Models;
use App\Core\AbstractUser;
use App\Core\AuthInterface;
include "DBconfig.php";
use PDO;

class User extends AbstractUser implements AuthInterface{
  protected $name;
  protected $password;
  
  public function __construct($name, $password, $doRegister) {
    $this->name = $name;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
    if($doRegister=="on"){
      if(!$this->saveToDB()){
        $this->logout();
      } 
   }else{

   }
    
  }
  public function logout(){
    header("Location: formUsernameTaken.php");
    exit;
  }

  public function login($name, $password){

  }

  protected function saveToDB(){
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
    //Patikrinu, ar vartotojas jau egzistuoja duomenų bazėje:
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $stmt = $conn->query($sql);
    if ($stmt->rowCount() > 0) {
        return false;
    }
    $sql="INSERT INTO users (name, password) VALUES ('".$name."','".$password."')";
    if ($conn->query($sql) == TRUE) {
	  	print ("Naujas irasas sukurtas");
      return true;
	  	// print ("<a href=list.php> Sarasas </a>");
  	} else {
	  	print ("Klaida");
      return false;
	  }
  }
}
?>