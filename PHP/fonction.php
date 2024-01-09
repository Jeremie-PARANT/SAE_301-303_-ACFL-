<?php
    function modelError($model)
    {
            if (!is_string($model))
            {
                return "<div class='erreur'> Le modèle doit être une chaîne de caractères. </div><br>";
            }
            elseif (strlen($model)>100)
            {
                return "<div class='erreur'> Le nom du modèle est trop long </div><br>";
            }
            else
            {
                return false;
            }
    }

    function dateError($date_debut, $date_fin)
    {
        if (empty($date_debut)) {
            return '<div class="erreur"> Vous devez remplir le champs, date de début </div>';
        }
        elseif (empty($date_fin)) {
            return '<div class="erreur"> Vous devez remplir le champs, date de fin </div>';
        }
        else {
            $today = date("Y-m-d H:i:s");
            $format = 'Y-m-d';
            $validate_date = DateTime::createFromFormat($format, $date_debut);
            if ((validateDate($date_debut, $format))!=true){
                return '<div class="erreur"> La date de début n\'est pas une date </div>';
            }
            elseif ((validateDate($date_fin, $format))!=true){
                return '<div class="erreur"> La date de fin n\'est pas une date </div>';
            }
            elseif ($date_debut < $today) {
                return '<div class="erreur"> Vous ne pouvez pas prendre de commande pour le passer </div>';
            }
            elseif ($date_fin < $today) {
                return '<div class="erreur"> Vous ne pouvez pas prendre de commande pour le passer, ou le jour même </div>';
            }
            elseif ($date_debut > $date_fin) {
                return '<div class="erreur"> La date de fin ne doit pas précèder la date de début </div>';
            }
            else {
                return false;
            }
        }
    }

    //Valide date de naissance
    function validateDate($naissance, $format)
    {
        if (DateTime::createFromFormat($format, $naissance)==true){
            return true;
        }
    }

    function dateReservError($date_debut, $date_fin, $date)
    {
        if (empty($date)) {
            return '<div class="erreur"> Vous devez remplir le champ date </div>';
        } else {
            $today = date("Y-m-d H:i:s");
            $format = 'Y-m-d';
            $validate_date = DateTime::createFromFormat($format, $date);

            if ((validateDate($date, $format)) != true) {
                return '<div class="erreur"> La date n\'est pas une date valide </div>';
            } elseif ($date > $date_fin || $date < $date_debut) {
                return '<div class="erreur"> La date doit être comprise entre la date de début et la date de fin </div>';
            } else {
                return false;
            }
        }
    }

    function numError($num) {
        if (!is_numeric($num)){
            return "<div class='erreur'> L'age doit être un nombre. </div><br>";
        }
        elseif ($num<0){
            return "<div class='erreur'> Le num ne peut pas être négatif </div><br>";
        }
        else{
            return false;
        }
    }

    function nameError($name) {
        if (empty($name))
        {
            return "<br><br><div class='erreur'> Le nom est obligatoire. </div>";
        }
        elseif (!is_string($name))
        {
            return "<br><br><div class='erreur'> Le nom doit être une chaîne de caractères. </div>";
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

    function firstnameError($firstname) {
        if (empty($firstname)){
            return "<br><div class='erreur'> Le prénom est obligatoire. </div>";
        }
        elseif (!is_string($firstname)){
            return "<br><div class='erreur'> Le prénom doit être une chaîne de caractères. </div>";
        }
        elseif (strlen($firstname)<2){
            return "<br><div class='erreur'> Votre prénom est trop court </div>";
        }
        elseif (strlen($firstname)>100){
            return "<br><div class='erreur'> Votre prénom est trop long </div>";
        }
        else{
            return false;
        }
    }

?>
