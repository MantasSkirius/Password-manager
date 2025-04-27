<?php
namespace App\Models;
use App\Core\AbstractUser;
use App\Core\AuthInterface;
use App\Core\Database;
use PDO;

class User extends AbstractUser implements AuthInterface{
  protected $name;
  protected $password;
  protected $conn;
  public function __construct($name, $password, $doRegister, $conn){
    $this->name = $name;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
    $this->conn = $conn;
    print("test: ".$this->name." ".$doRegister."<br>");
    if($doRegister=="TRUE"){
      print("register: ".$this->name." ".$this->password."<br>");
      if(!$this->saveToDB()){
        $this->logout();
      } 
   }else{
      print("login: ".$this->name." ".$this->password."<br>");
      $this->login($name, $password);
   }
    
  }
  function logout(){
    header("Location: formUsernameTaken.php");
    exit;
  }

  function login($name, $password){
    print("Vartotojas bando jungtis: ".$name."<br>");
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $stmt = $this->conn->query($sql);
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $row['password'])) {
            print("Vartotojas prisijungė: ".$row['name']."<br>");
            return true;
        } else {
            print("Neteisingas slaptažodis<br>");
            return false;
        }
    } else {
        print("Vartotojas nerastas<br>");
        return false;
    }
  }

  function saveToDB(){
    $name=$this->name;
    $password=$this->password;
    //Patikrinu, ar vartotojas jau egzistuoja duomenų bazėje:
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $stmt = $this->conn->query($sql);
    if ($stmt->rowCount() > 0) {
        return false;
    }
    $sql="INSERT INTO users (name, password) VALUES ('".$name."','".$password."')";
    if ($this->conn->query($sql) == TRUE) {
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