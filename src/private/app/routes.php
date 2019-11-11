<?php

$app->post('/register', 'AuthenticationController:registerUser');
$app->post('/login', 'AuthenticationController:loginUser');
$app->post('/logout', 'AuthenticationController:logoutUser');
