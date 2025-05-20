<?php
namespace App\Models;
use App\Core\AbstractUser;
use App\Core\AuthInterface;
use App\Core\RandomString;
use PDO;
class User extends AbstractUser implements AuthInterface{
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
        print ("<a href=list.php> Sarasas </a>");
      }
      else{
        print ("<a href=form.php> Bandykite dar kartą </a>");
      }
   }
    
  }
  function logout(){
    header("Location: form.php");
    exit;
  }

  function login($name, $password){
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
    $key = new RandomString(128);
    $key = $key->getStringas();
    //Patikrinu, ar vartotojas jau egzistuoja duomenų bazėje:
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $stmt = $this->conn->query($sql);
    if ($stmt->rowCount() > 0) {
        return false;
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $encryptedKey = openssl_encrypt($key, 'AES-256-ECB', $password, 0);
    $_SESSION['key'] = $key;
    
    $sql="INSERT INTO users (name, password, raktas) VALUES ('".$name."','".$hashedPassword."','".$encryptedKey."')";
    if ($this->conn->query($sql) == TRUE) {
	  	print ("<br>Naujas irasas sukurtas<br>");
      return true;
	  	print ("<a href=list.php> Slaptažodžių sąrasas </a>");
  	} else {
	  	print ("Klaida");
      return false;
	  } 
  }
}
?>