<?php
namespace App\Core;
abstract class AbstractUser {
protected $name;
protected $password;
public function getName() {
return $this->name;
}
public function getPassword() {
return $this->password;
}

protected function saveToDB(){
}
}
?>