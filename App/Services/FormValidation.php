<?php
namespace App\Services;

class FormValidation {
    public function testuotigautusduomenis($duomuo) {
        $duomuo = stripslashes($duomuo);
        $duomuo = htmlspecialchars($duomuo);
        return trim($duomuo);
    }
}