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
            return "<div class='erreur'> Le nom est obligatoire. </div><br>";
        }
        elseif (!is_string($name))
        {
            return "<div class='erreur'> Le nom doit être une chaîne de caractères. </div><br>";
        }
        elseif (strlen($name)<2)
        {
            return "<div class='erreur'> Votre nom est trop court </div><br>";
        }
        elseif (strlen($name)>100)
        {
            return "<div class='erreur'> Votre nom est trop long </div><br>";
        }
        else
        {
            return false;
        }
    }

    public static function surnameError($surname) {
        if (empty($surname)){
            return "<div class='erreur'> Le prénom est obligatoire. </div><br>";
        }
        elseif (!is_string($surname)){
            return "<div class='erreur'> Le prénom doit être une chaîne de caractères. </div><br>";
        }
        elseif (strlen($surname)<2){
            return "<div class='erreur'> Votre prénom est trop court </div><br>";
        }
        elseif (strlen($surname)>100){
            return "<div class='erreur'> Votre prénom est trop long </div><br>";
        }
        else{
            return false;
        }
    }

    public static function mailError($mail) {
        if (empty($mail)){
            return "<div class='erreur'> Le email est obligatoire. </div><br>";
        }
        elseif (!is_string($mail)){
            return "<div class='erreur'> Le email doit être une chaîne de caractères. </div><br>";
        }
        elseif (strlen($mail)<2){
            return "<div class='erreur'> Votre email est trop courte </div><br>";
        }
        elseif (strlen($mail)>100){
            return "<div class='erreur'> Votre email est trop longue </div><br>";
        }

        elseif (filter_var($mail, FILTER_VALIDATE_EMAIL)==false) {
            return "<div class='erreur'> Email invalide </div><br>";
        }
        else{
            return false;
        }
    }

    public static function ageError($age) {
        if (!is_numeric($age)){
            return "<div class='erreur'> L'age doit être un nombre. </div><br>";
        }
        elseif ($age>200){
            return "<div class='erreur'> Vous ne pouvez pas avoir 200 ans </div><br>";
        }
        elseif ($age<0){
            return "<div class='erreur'> Vous ne pouvez pas avoir un age négatif </div><br>";
        }
        else{
            return false;
        }
    }

    public static function phoneError($phone) {
        // récupérer la longueur du numéro de téléphone
        if (!is_string($phone)){
            return "<div class='erreur'> Le numéro de téléphone doit être une chaine de charactère. </div><br>";
        }
        elseif (strlen($phone) != 10){
            return "<div class='erreur'> Le numéro de téléphone doit contenir 10 chiffre (attention au espace) </div><br>";
        }
        elseif (!preg_match('/^[0-9]+$/', $phone)){
            return "<div class='erreur'> Le numéro de téléphone uniquement contenir des chiffre </div><br>";
        }
        else{
            return false;
        }
    }

    public static function otherError($other) {
        if (!is_string($other)){
            return "<div class='erreur'> Les informations complémentaire doivent être une chaine de charactère </div><br>";
        }
        elseif (strlen($other)>1000){
            return "<div class='erreur'> Les informations complémentaires ne doivent pas dépasser les 1000 charactères </div><br>";
        }
        else{
            return false;
        }
    }
}