<?php
namespace App\Models;

use App\Core\AbstractDatabaseObject;
use App\Core\connectToDB;
session_start();
class Password extends AbstractDatabaseObject{
    private $siteName;
    private $sitePassword;
    private $date;
	private $key ;
    private $user_name;
    private $conn;
    public function __construct($login, $password) {
        $this->key = $_SESSION['key']; 
        $this->date = date("Y-m-d H:i:s");
        $this->siteName = $login;
        $this->sitePassword = $password;
        print("unencrypted password: ".$this->sitePassword."<br>");
        $this->sitePassword = openssl_encrypt($this->sitePassword, 'AES-256-ECB', $this->key, 0);
        print("encrypted password: ".$this->sitePassword."<br>");
        $this->user_name = $_SESSION['active_user'];
        $this->conn = new connectToDB();
        $this->conn = $this->conn->getconnection();
        $this->saveToDb();
    }

    protected function saveToDb(){
	$sql="INSERT INTO passwords (user_name, site, date ,encrypted_password) VALUES ('".$this->user_name."','".$this->siteName."','".$this->date."','".$this->sitePassword."')";
	if ($this->conn->query($sql) == TRUE) {
        print("Naujas įrašas sukurtas sėkmingai<br>");
        print("<br><a href=listPasswords.php>Slaptažodžių sąrašas</a>");
    }
    }
}
?>