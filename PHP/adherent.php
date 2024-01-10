<?php
namespace App\Database;

class adherent {
    private static $instance;
    // Déclaration des propriétés
    public String $name;
    public String $surname;
    public String $mail;
    public ?int $age;
    public ?String $phone;
    public String $activity;
    public String $other;

    // Les constructeur
    public function __construct(String $name, String $surname, String $mail, ?int $age, ?String $phone, String $activity, String $other) {
        $this->name = $name;
        $this->surname = $surname;
        $this->mail = $mail;
        $this->age = $age;
        $this->phone = $phone;
        $this->activity = $activity;
        $this->other = $other;
    }

    // Les méthodes (vérifications des erreurs)
    public static function nameError($name) {
        if (empty($name))
        {
            return "<br><br><div class='erreur'> Le nom est obligatoire. </div>";
        }
        elseif (!is_string($name))
        {
            return "<br><br><div class='erreur'> Le nom doit être une chaîne de caractères. </div>";
        }
        elseif (!preg_match("#^[A-Z]+$#", $name[0])) {
            $erreur_nom =  '<div class="erreur"> La 1ere lettre en majuscule </div>';
            return $erreur_nom;
        }
        elseif (strlen($name)<2)
        {
            return "<br><br><div class='erreur'> Votre nom est trop court </div>";
        }
        elseif (strlen($name)>100)
        {
            return "<br><div class='erreur'> Votre nom est trop long </div>";
        }
        else
        {
            return false;
        }
    }

    public static function surnameError($surname) {
        if (empty($surname)){
            return "<br><div class='erreur'> Le prénom est obligatoire. </div>";
        }
        elseif (!is_string($surname)){
            return "<br><div class='erreur'> Le prénom doit être une chaîne de caractères. </div>";
        }
        elseif (!preg_match("#^[A-Z]+$#", $surname[0])) {
            $erreur_nom =  '<div class="erreur"> La 1ere lettre en majuscule </div>';
            return $erreur_nom;
        }
        elseif (strlen($surname)<2){
            return "<br><div class='erreur'> Votre prénom est trop court </div>";
        }
        elseif (strlen($surname)>100){
            return "<br><div class='erreur'> Votre prénom est trop long </div>";
        }
        else{
            return false;
        }
    }

    public static function mailError($mail) {
        if (empty($mail)){
            return "<br><div class='erreur'> Le e-mail est obligatoire. </div>";
        }
        elseif (!is_string($mail)){
            return "<br><div class='erreur'> Le e-mail doit être une chaîne de caractères. </div>";
        }
        elseif (strlen($mail)<2){
            return "<br><div class='erreur'> Votre e-mail est trop courte </div>";
        }
        elseif (strlen($mail)>100){
            return "<br><div class='erreur'> Votre e-mail est trop longue </div>";
        }

        elseif (filter_var($mail, FILTER_VALIDATE_EMAIL)==false) {
            return "<br><div class='erreur'> E-mail invalide </div>";
        }
        else{
            return false;
        }
    }

    public static function ageError($age) {
        if (!is_numeric($age)){
            return "<br><div class='erreur'> L'âge doit être un nombre. </div>";
        }
        elseif ($age < 18){
            return "Vous devez être majeur pour vous inscrire !";
        }
        elseif ($age>200){
            return "<br><div class='erreur'> Vous ne pouvez pas avoir 200 ans </div>";
        }
        elseif ($age<0){
            return "<br><div class='erreur'> Vous ne pouvez pas avoir un âge négatif </div>";
        }
        else{
            return false;
        }
    }

    public static function phoneError($phone) {
        // récupérer la longueur du numéro de téléphone
        if (!is_string($phone)){
            return "<br><div class='erreur'> Le numéro de téléphone doit être une chaine de charactère. </div>";
        }
        elseif (strlen($phone) != 10){
            return "<br><div class='erreur'> Le numéro de téléphone doit contenir 10 chiffre (attention aux espaces) </div>";
        }
        elseif (!preg_match('/^[0-9]+$/', $phone)){
            return "<br><div class='erreur'> Le numéro de téléphone doit uniquement contenir des chiffres </div>";
        }
        else{
            return false;
        }
    }

    public static function otherError($other) {
        if (!is_string($other)){
            return "<br><div class='erreur'> Les informations complémentaire doivent être une chaine de caractère </div>";
        }
        elseif (strlen($other)>1000){
            return "<br><div class='erreur'> Les informations complémentaires ne doivent pas dépasser les 1000 caractères </div>";
        }
        else{
            return false;
        }
    }
}