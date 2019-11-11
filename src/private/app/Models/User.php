<?php

namespace App\Models;

class User
{
    private $id;
    private $email;
    private $username;
    private $password;

    public function __construct(Email $email, Username $username, Password $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(Email $email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(Username $username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(Password $password)
    {
        $this->password = $password;
    }
}
