<?php

namespace Controllers;

use Models\Note;
use Models\User;

class NoteController
{
    private $noteModel;
    private $userModel;

    private $user_id;

    function __construct()
    {
        $this->noteModel = new Note();
        $this->userModel = new User();
        $this->user_id = $_SESSION["user_id"];
    }

    function index()
    {
        $user = $this->userModel->getUserById($this->user_id);
        $notes = $this->noteModel->select($this->user_id);
        $total = $this->noteModel->getTotal($this->user_id);
        return view("diary/index", ["notes" => $notes, "user" => $user, "total" => $total]);
    }

    function add()
    {
        $judul = $_POST["judul"];
        $catatan = $_POST["catatan"];

        if ($this->noteModel->insert(["judul" => $judul, "catatan" => $catatan, "user_id" => $this->user_id])) {
            return redirect(BASE_URL);
        } else {
            return redirect(BASE_URL);
        }
    }

    function update()
    {
        $id = $_POST["edit-id"];
        $judul = $_POST["edit-judul"];
        $catatan = $_POST["edit-catatan"];

        if ($this->noteModel->update($id, ["judul" => $judul, "catatan" => $catatan, "user_id" => $this->user_id])) {
            return redirect(BASE_URL);
        } else {
            return redirect(BASE_URL);
        }
    }

    function delete()
    {
        $id = $_POST["id"];
        $user_id = $_SESSION["user_id"];

        if ($this->noteModel->delete($id, $user_id)) {
            return redirect(BASE_URL);
        } else {
            return redirect(BASE_URL);
        }
    }
}
