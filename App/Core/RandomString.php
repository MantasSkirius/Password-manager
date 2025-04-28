<?php
namespace App\Core;
class RandomString {
private $lowercase = 'abcdefghijklmnopqrstuvwxyz';
private $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
private $numbers = '0123456789';
private $specialChars = '!@#$%^&*()_+-=[]{}|;:,.<>?';
private $lowercase_number= 4;
private $uppercase_number = 0;
private $numbers_number = 4;
private $specialChars_number = 0;
private $max_length;
private $stringas = '';
public function __construct($length) {
  $this->max_length = $this->lowercase_number + $this->uppercase_number + $this->numbers_number + $this->specialChars_number;
  for($i = 0; $i < $length and $i < $this->max_length; $i++){
    $pasirinkimas = random_int(0, 3);
    switch($pasirinkimas){
      case 0:
        if($this->lowercase_number > 0){
          $this->lowercase_number--;
          $this->stringas .= $this->lowercase[random_int(0, strlen($this->lowercase) - 1)];
        }else{
          $i--;
        }
        break;
      case 1:
        if($this->uppercase_number > 0){
          $this->uppercase_number--;
          $this->stringas .= $this->uppercase[random_int(0, strlen($this->uppercase) - 1)];
        }else{
          $i--;
        }
        break;
      case 2:
        if($this->numbers_number > 0){
          $this->numbers_number--;
          $this->stringas .= $this->numbers[random_int(0, strlen($this->numbers) - 1)];
        }else{
          $i--;
        }
        break;
      case 3:
        if($this->specialChars_number > 0){
          $this->specialChars_number--;
          $this->stringas .= $this->specialChars[random_int(0, strlen($this->specialChars) - 1)];
        }else{
          $i--;
        }
        break;
    }
  }
  for($i = strlen($this->stringas); $i < $length; $i++){
    $pasirinkimas = random_int(0, 3);
    switch($pasirinkimas){
      case 0:
        $this->stringas .= $this->lowercase[random_int(0, strlen($this->lowercase) - 1)];
        break;
      case 1:
        $this->stringas .= $this->uppercase[random_int(0, strlen($this->uppercase) - 1)];
        break;
      case 2:
        $this->stringas .= $this->numbers[random_int(0, strlen($this->numbers) - 1)];
        break;
      case 3:
        $this->stringas .= $this->specialChars[random_int(0, strlen($this->specialChars) - 1)];
        break;
    }
  }
}
public function getStringas() {
  return $this->stringas;
}
}
?>