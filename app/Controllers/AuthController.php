<?php

namespace Controllers;

class AuthController
{

    function login()
    {
        return view("auth/login");
    }

    function register()
    {
        return view("auth/register");
    }
}
