<?php


namespace App\Models;


use App\Models\Exceptions\InvalidFormData;

class Password
{
    private $password, /*$password_confirm,*/ $error_message;
    private const MIN_LENGTH = 8, MAX_LENGTH = 128;

    public function __construct(string $tainted_password /*string $tainted_password_confirm*/)
    {
        $cleaned_password = filter_var($tainted_password, FILTER_SANITIZE_STRING);
        //$cleaned_password_confirm = filter_var($tainted_password_confirm, FILTER_SANITIZE_STRING);

        if ($this->isPasswordValid($cleaned_password))
        throw new InvalidFormData($this->error_message);

        $this->password = $cleaned_password;
       // $this->password_confirm = $cleaned_password_confirm;
    }

    private function isPasswordValid($cleaned_password)
    {
        return $this->isEmpty($cleaned_password) || $this->isTooShort($cleaned_password) ||
        $this->isTooLong($cleaned_password) || $this->doesContainLowercaseChar($cleaned_password) ||
        $this->doesContainUppercaseChar($cleaned_password) || $this->doesContainNumber($cleaned_password) ||
        $this->doesContainSpace($cleaned_password) ? true : false;
    }

    private function isEmpty(string $password)
    {
        return empty($password) ?
            true && $this->error_message = 'A password is required' : false;
    }

    private function isTooShort(string $password)
    {
        return strlen($password) < self::MIN_LENGTH ?
            true && $this->error_message = 'Password must be at least 8 characters' : false;
    }

    private function isTooLong(string $password)
    {
        return strlen($password) > self::MAX_LENGTH ?
            true && $this->error_message = 'Password must not exceed 128 characters' : false;
    }

    private function doesContainLowercaseChar(string $password)
    {
        return !preg_match('/[a-z]/', $password) ?
            true && $this->error_message = 'Password must contain at least one lowercase character' : false;
    }

    private function doesContainUppercaseChar(string $password)
    {
        return !preg_match('/[A-Z]/', $password) ?
            true && $this->error_message = 'Password must contain at least one uppercase character' : false;
    }

    private function doesContainNumber(string $password)
    {
        return !preg_match('/[0-9]/', $password) ?
            true && $this->error_message = 'Password must contain at least one number' : false;
    }

    private function doesContainSpace(string $password)
    {
        return preg_match('/\s/', $password) ?
            true && $this->error_message = 'Password must not contain a space' : false;
    }

    public function __toString()
    {
        return $this->password;
    }
}
