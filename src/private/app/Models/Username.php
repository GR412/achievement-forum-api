<?php


namespace App\Models;


class Username
{
    private $username;
    // private const MAX_LENGTH = 128, MIN_LENGTH = 2;

    public function __construct(string $tainted_username)
    {
        $cleaned_username = filter_var($tainted_username, FILTER_SANITIZE_STRING);

        $this->username = $cleaned_username;
    }

    public function __toString() {
        return $this->username;
    }

}
