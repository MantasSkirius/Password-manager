<?php
namespace App\Core;
use App\Core\connectToDB;
class RandomPassword {
protected $lowercase = 'abcdefghijklmnopqrstuvwxyz';
protected $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
protected $numbers = '0123456789';
protected $specialChars = '!@#$%^&*()_+-=[]{}|;:,.<>?';
protected $lowercase_number;
protected $uppercase_number;
protected $numbers_number;
protected $specialChars_number;
protected $stringas = '';
protected $length;

public function __construct() {
  #Iš duomenų bazės paimami slaptažodžio nustatymai:
  session_start();
  $conn = new connectToDB();
  $conn = $conn->getConnection();
  $user = $_SESSION['active_user'];
  $sql = "SELECT * FROM users WHERE name = '$user'";
  $stmt = $conn->query($sql);
  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    $this->lowercase_number = $row['lowercase_number'];
    $this->uppercase_number = $row['uppercase_number'];
    $this->numbers_number = $row['numbers_number'];
    $this->specialChars_number = $row['special_number'];
  }
  #Maksimalus slaptažodžio ilgis - visų nustatymų suma:
  $this->length = $this->lowercase_number + $this->uppercase_number + $this->numbers_number + $this->specialChars_number;
  for($i = 0; $i < $this->length; $i++){
    #Atsitiktinai atrenkamas simbolis pridemamas prie eilutės:
    $this->stringas .= $this->generateRandomCharacter();
  }
}

protected function generateRandomCharacter(){

  while(TRUE){
    $pasirinkimas = random_int(0, 3);
    switch($pasirinkimas){
    case 0:
      if($this->lowercase_number > 0){
        $this->lowercase_number--;
        return $this->lowercase[random_int(0, strlen($this->lowercase) - 1)];
      }
      break;
    case 1:
      if($this->uppercase_number > 0){
        $this->uppercase_number--;
        return $this->uppercase[random_int(0, strlen($this->uppercase) - 1)];
      }
      break;
    case 2:
      if($this->numbers_number > 0){
        $this->numbers_number--;
        return $this->numbers[random_int(0, strlen($this->numbers) - 1)];
      }
      break;
    case 3:
      if($this->specialChars_number > 0){
        $this->specialChars_number--;
        return $this->specialChars[random_int(0, strlen($this->specialChars) - 1)];
      }
      break;
    }
  }
}

public function getStringas() {
  return $this->stringas;
}
}
?>