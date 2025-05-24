<?php
    require 'autoload.php';

use App\Core\connectToDB;
use App\Services\FormValidation;
use App\Models\User;
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $validatorius = new FormValidation;
        $name = $validatorius->testuotiGautusDuomenis($_POST["username"]);
        $password = $validatorius->testuotiGautusDuomenis($_POST["password"]);
        $doRegister = $validatorius->testuotiGautusDuomenis($_POST["doRegister"]);
        $db = new connectToDB();
        $conn = $db->getConnection();
        $vartotojas = new User($name, $password, $doRegister, $conn);
        $_SESSION['active_user']=$name;
        exit;
    }
    
?>

