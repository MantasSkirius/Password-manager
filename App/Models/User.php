<?php
namespace App\Models;
use App\Core\AbstractDatabaseObject;
use App\Core\AuthInterface;
use App\Core\RandomString;
use PDO;
class User extends AbstractDatabaseObject implements AuthInterface{
  protected $name;
  protected $password;
  protected $conn;
  protected $key;
  public function __construct($name, $password, $doRegister, $conn){
    $this->name = $name;
    $this->password = $password;
    $this->conn = $conn;
    if($doRegister=="TRUE"){
      if(!$this->saveToDB()){
        $this->logout();
      } 
   }else{
      $this->password = password_hash($password, PASSWORD_DEFAULT);
      if($this->login($name, $password)){
        print("Vartotojas prisijungė: ".$name."<br>");
        print ("<a href=listPasswords.php> Sąrašas </a>");
      }
      else{
        print ("<a href=loginForm.php> Bandykite dar kartą </a>");
      }
   }
    
  }
  public function logout(){
    print ("<a href=loginForm.php> Bandykite dar kartą </a>");
    exit;
  }

  public function login($name, $password){
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

  protected function saveToDB(){
    $name=$this->name;
    $password=$this->password;
    //Raktas yr 128 simbolių ilgio atsitiktinis tekstas, užkoduojamas AES kaip rakta naudojant PLAIN slaptąžodį:
    $key = new RandomString(128);
    $key = $key->getStringas();
    //Patikrinu, ar vartotojas jau egzistuoja duomenų bazėje:
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $stmt = $this->conn->query($sql);
    if ($stmt->rowCount() > 0) {
        print("Vartotojas jau egzistuoja<br>");
        return false;
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $encryptedKey = openssl_encrypt($key, 'AES-256-ECB', $password, 0);
    $_SESSION['key'] = $key;
    
    $sql="INSERT INTO users (name, password, raktas) VALUES ('".$name."','".$hashedPassword."','".$encryptedKey."')";
    if ($this->conn->query($sql) == TRUE) {
	  	print ("Naujas įrašas sukurtas<br>");
	  	print ("<a href=listPasswords.php> Slaptažodžių sąrasas </a>");
      return true;
  	} else {
	  	print ("Klaida");
      return false;
	  } 
  }
}
?>