<?php

function authFilter()
{
    if (!isset($_SESSION["user_id"])) {
        header("Location: /login");
        exit;
    }
}

function guestFilter()
{
    if (isset($_SESSION["user_id"])) {
        header("Location: /");
        exit;
    }
}
