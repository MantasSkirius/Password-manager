<?php
    require 'autoload.php';
    use App\Services\FormValidation;
    use App\Core\User;
    use App\Services\UserAuthentication;
    //skaičiu pasirinkimas:
    $pradinisSkaicius = $galinisSkaicius = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST siuntimas pavyko<br> su POST atsiusta: ";
        echo var_dump($_POST)."<br>";
        $validatorius = new FormValidation;
        $name = $validatorius->testuotiGautusDuomenis($_POST["username"]);
        $password = $validatorius->testuotiGautusDuomenis($_POST["password"]);
        echo "vardas: ".$_POST["username"]." slaptazodis: ".$_POST["password"]."<br>";
        $vartotojas = new User($name, $password);
    }
    
?>

