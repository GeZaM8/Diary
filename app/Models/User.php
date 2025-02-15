<?php

namespace Models;

use Controllers\DatabaseController;

class User extends DatabaseController
{
    function getUserByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT password, id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPassword, $user_id);
            $stmt->fetch();
            return ["id" => $user_id, "password" => $hashedPassword];
        }
        return null;
    }

    function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            return redirect("/logout");
        }
        $result = $stmt->get_result();
        return $result->fetch_object();
    }

    function checkUsernameExists($username)
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->num_rows > 0;
    }

    function createUser($username, $password)
    {
        $stmt = $this->conn->prepare("INSERT INTO users(username, password) VALUES (?, ?)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $username, $hashedPassword);
        return $stmt->execute();
    }
}
