<?php

namespace Controllers;

use Models\User;

class UserController extends DatabaseController
{
    private $userModel;

    function __construct()
    {
        $this->userModel = new User();
    }

    function login()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $this->userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            return redirect(BASE_URL, ["message" => "Berhasil login"]);
        } else {
            return view("auth/login", ["error" => "Username atau Password salah"]);
        }

        $stmt->close();
        return view("auth/login", ["error" => "Username atau Password salah"]);
    }

    function register()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cPassword = $_POST["cPassword"];

        if ($password != $cPassword) {
            return view("auth/register", ["error" => "Confirm Password tidak sama"]);
        }
        if ($this->userModel->checkUsernameExists($username)) {
            return view("auth/register", ["error" => "Username sudah terdaftar"]);
        }
        if ($this->userModel->createUser($username, $password)) {
            return redirect("login", ["message" => "Berhasil melakukan register"]);
        }

        return view("auth/register", ["error" => "Terjadi kesalahan"]);
    }
}
