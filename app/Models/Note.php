<?php

namespace Models;

use Controllers\DatabaseController;

class Note extends DatabaseController
{
    function select($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM notes WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            return [];
        }
        $result = $stmt->get_result();

        $notes = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $notes[] = $row;
            }
        }
        return $notes;
    }

    function insert($data)
    {
        $judul = $data["judul"];
        $catatan = $data["catatan"];
        $user_id = $data["user_id"];

        $stmt = $this->conn->prepare("INSERT INTO notes(judul, catatan, user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $judul, $catatan, $user_id);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function update($id, $data)
    {
        $judul = $data["judul"];
        $catatan = $data["catatan"];
        $user_id = $data["user_id"];

        $stmt = $this->conn->prepare("UPDATE notes SET judul = ?, catatan = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ssii", $judul, $catatan, $id, $user_id);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function delete($id, $user_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM notes WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $user_id);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function getTotal($user_id)
    {
        $stmt = $this->conn->prepare("SELECT count(id) as total FROM notes WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);

        if (!$stmt->execute()) {
            return 0;
        }
        $result = $stmt->get_result();

        return $result->fetch_object()->total;
    }
}
