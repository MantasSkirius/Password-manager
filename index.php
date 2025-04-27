<?php
    require 'autoload.php';

use App\Core\connectToDB;
use App\Services\FormValidation;
    use App\Models\User;
    use App\Services\UserAuthentication;
    use App\Core\Database;
    use App\Core\RandomString;
    //skaičiu pasirinkimas:
    $pradinisSkaicius = $galinisSkaicius = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST siuntimas pavyko<br> su POST atsiusta: ";
        echo var_dump($_POST)."<br>";
        $validatorius = new FormValidation;
        $name = $validatorius->testuotiGautusDuomenis($_POST["username"]);
        $password = $validatorius->testuotiGautusDuomenis($_POST["password"]);
        $doRegister = $validatorius->testuotiGautusDuomenis($_POST["doRegister"]);
        echo "vardas: ".$_POST["username"]." slaptazodis: ".$_POST["password"]."<br>";
        $db = new connectToDB;
        $conn = $db->getConnection();
        $vartotojas = new User($name, $password, $doRegister, $conn);
        $atsitiktinisSkaicius = new RandomString(10);
        print("atsitiktinis skaicius: ".$atsitiktinisSkaicius->getStringas()."<br>");
    }
    
?>

