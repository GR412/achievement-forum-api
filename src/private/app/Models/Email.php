<?php


namespace App\Models;


class Email
{
    private $email;
    //private const  MAX_LENGTH = 128;

    public function __construct(string $tainted_email)
    {
        $cleaned_email = filter_var($tainted_email, FILTER_SANITIZE_EMAIL);

        /*if (!$this->isEmailValid($cleaned_email))
            return "INVALID EMAIL";*/

        $this->email = $cleaned_email;

    }

    // TODO figure out the logic of these validation methods

    /*public function isEmailValid(string $cleaned_email)
    {
        return $this->isEmpty($cleaned_email) || $this->exceedsMaxLength($cleaned_email) || $this->isWellFormatted($cleaned_email) ? true : false;
    }

    private function isEmpty(string $cleaned_email)
    {
        return empty($cleaned_email) ? true : false;
    }

    private function exceedsMaxLength(string $cleaned_email)
    {
        return !strlen($cleaned_email) > self::MAX_LENGTH ? true : false;
    }

    private function isWellFormatted(string $cleaned_email)
    {
        return filter_var($cleaned_email, FILTER_VALIDATE_EMAIL) ? true : false;

    }*/

    public function __toString() {
        return $this->email;
    }
}
