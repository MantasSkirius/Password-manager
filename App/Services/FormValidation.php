<?php
namespace App\Services;

class FormValidation {
    public function testuotiGautusDuomenis($duomuo) {
        $duomuo = stripslashes($duomuo);
        $duomuo = htmlspecialchars($duomuo);
        return trim($duomuo);
    }
}