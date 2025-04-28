<?php
namespace App\Models;
use App\Core\connectToDB;
session_start();
class Password {
    private $siteName;
    private $sitePassword;
    private $date;
	private $key ;
    private $user_name;
    public function __construct($login, $password) {
        $this->key = $_SESSION['key']; 
        $this->date = date("Y-m-d H:i:s");
        $this->siteName = $login;
        $this->sitePassword = $password;
        print("unencrypted password: ".$this->sitePassword."<br>");
        $this->sitePassword = openssl_encrypt($this->sitePassword, 'AES-256-ECB', $this->key, 0);
        print("encrypted password: ".$this->sitePassword."<br>");
        $this->user_name = $_SESSION['active_user'];
        $conn = new connectToDB();
        $conn = $conn->getConnection();
        $this->saveToDb($conn);
    }

    private function saveToDb($conn){
	$sql="INSERT INTO passwords (user_name, site, date ,encrypted_password) VALUES ('".$this->user_name."','".$this->siteName."','".$this->date."','".$this->sitePassword."')";
	if ($conn->query($sql) == TRUE) {
        print("Naujas įrašas sukurtas sėkmingai<br>");
        print("<br>".$this->key);
        print("<br><a href=listPasswords.php>Slaptažodžių sąrašas</a>");
    }
    }

    public function getConnection() {
        
    }
}
?>