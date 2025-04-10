<?php
namespace App\Services;

class UserAuthentication {
    public function AuthenticateUserLogin($duomuo) {
        $duomuo = stripslashes($duomuo);
        $duomuo = htmlspecialchars($duomuo);
        return $duomuo;
    }
}
?>