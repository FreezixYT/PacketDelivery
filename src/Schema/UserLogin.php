<?php

namespace Root\Www\Schema;

class UserLogin
{
    public string $email;
    public string $password;


    public function __construct(array $data) {
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
    }


    public function validate() : array
    {
        $errors = [];

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email dois etre rempli";
        }

        if (empty($this->password)) {
            $errors[] = "Le mot de passe est obligatoire";
        }
        return $errors;
    }
}