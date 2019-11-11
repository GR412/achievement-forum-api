<?php

namespace App\Services;
use App\DataMappers\UserMapper;
use App\Models\Email;
use App\Models\Password;
use App\Models\User;
use App\Models\Username;

class AuthenticationService
{
    protected $userMapper;

    // constructor receives container instance
    public function __construct(UserMapper $userMapper)
    {
        $this->userMapper = $userMapper;
    }

    public function registerUser (string $tainted_username, string $tainted_password)
    {
        $email = new Email('testemail');
        $username = new Username($tainted_username);
        $password = new Password($tainted_password);

        $user = new User($email, $username, $password);

        return $this->userMapper->saveUser($user);

    }

}
