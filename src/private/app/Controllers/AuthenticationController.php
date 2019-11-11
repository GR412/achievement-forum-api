<?php

namespace App\Controllers;

use App\Models\Exceptions\InvalidFormData;
use App\Services\AuthenticationService;

class AuthenticationController
{
    private $authenticationService;

    // constructor receives container instance
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function registerUser($request, $response)
    {
        $tainted_username = $request->getParsedBody()['username'];
        $tainted_password = $request->getParsedBody()['password'];
        $validationResponse = null;

        try
        {
            $this->authenticationService->registerUser($tainted_username, $tainted_password);
            $validationResponse = ['error' => false, 'message' => ''];
        }

        catch(InvalidFormData $e)
        {
            $validationResponse = ['error' => true, 'message' => $e->getMessage()];
        }

        return $jsonResponse = $response->withJson($validationResponse);
    }

    public function loginUser($request, $response)
    {

    }

    public function logoutUser($request, $response)
    {

    }
}
