<?php
namespace App\Database;

class adherent {
    private static $instance;
    // déclaration d'une propriété
    public String $name;
    public String $surname;
    public String $email;

    // déclaration des méthodes
    public function __construct(String $name, String $surname, String $email) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }
}