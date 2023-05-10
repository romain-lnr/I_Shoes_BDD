<?php
//=============================================================================
// Auth script for ooless web apps.
// Author:  Pascal Hurni
// Date:    2022-08-27, 03-05-2014
//=============================================================================

function authorize($bag)
{
    // Try to authenticate user
    $bag['current_user'] = getCurrentUser();

    return $bag;
}

//=============================================================================
// User session functions

require_once SOURCE_DIR.'/models/user.php';

function getCurrentUser()
{
    return isset($_SESSION['current_user']) ? findUser($_SESSION['current_user']) : null;
}

function loginUser($username, $password)
{
    if ($user = findUser($username)) {
        // Check credential
        if (password_verify($password, $user['password'])) {
            $_SESSION['current_user'] = $user['username'];
        } else {
            $user = null;
        }
    }
    return $user;
}

function logoutUser()
{
    unset($_SESSION['current_user']);
}
