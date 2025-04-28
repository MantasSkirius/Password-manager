<?php
    require 'autoload.php';

use App\Core\connectToDB;
use App\Services\FormValidation;
    use App\Models\User;
    use App\Core\RandomString;
    //skaičiu pasirinkimas:
    session_start();
    $pradinisSkaicius = $galinisSkaicius = "";
    global $vartotojas;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $validatorius = new FormValidation;
        $name = $validatorius->testuotiGautusDuomenis($_POST["username"]);
        $password = $validatorius->testuotiGautusDuomenis($_POST["password"]);
        $doRegister = $validatorius->testuotiGautusDuomenis($_POST["doRegister"]);
        $db = new connectToDB();
        $conn = $db->getConnection();
        $vartotojas = new User($name, $password, 
        $doRegister, $conn);
        $_SESSION['active_user']=$name;
        $atsitiktinisSkaicius = new RandomString(10);
        print("<a href=listPasswords.php>Slaptažodžių sąrašas</a>");
        exit;
    }
    
?>

