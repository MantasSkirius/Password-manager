<?php
namespace App\Core;
use App\Core\RandomPassword;
class RandomString extends RandomPassword {
#Ši klasė yra naudojama sukurti atsitiktinę simbolių eilutę, ilgesnę nei maksimalus slaptažodžio ilgis nustatymuose.
#Vartotojo slaptažodžio nustatymų nenaudoja.
public function __construct() {
  for($i = 0; $i < $this->length; $i++){
    $this->stringas .= $this->generateRandomCharacter();
  }
}
}
?>