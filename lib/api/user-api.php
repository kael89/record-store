<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("tables");
requirePhp("api", "user");
requirePhp("class", "user");

function createUser($firstName = "", $lastName = "", $email = "", $password = "", $admin = 0) {
    $row = [];

    if ($firstName === "" || $lastName === "" || $email === "" || $password === "") {
        return null;
    }
    $row["firstName"] = $firstName;
    $row["lastName"] = $lasstName;
    $row["email"] = $email;
    $row["password"] = getSalted($password);
    $row["admin"] = $admin;

    if ($insertId = insertRow("users", $row)) {
        return new User($insertId, $firstName, $lastName, $email, $password, $admin);
    } else {
        return null;
    }
}

function updateUser($id, $row) {
    return updateRow("users", $row, ["userId=" => $id]);
}

function loginUser($email, $password) {
    if (empty($email) || empty($password)) {
        return null;
    }

    $columns = getColumns("users");
    $columns["users.email"] = "='$email'";
    $columns["users.password"] = "='" . getSalted($password) . "'";
    $result = getRows("users", $columns);

    if (!$result) {
        return false;
    }

    extract($result[0]);
    $user = new User($userId, $firstName, $lastName, $email, $password, $admin);
    setSession(["user" => $user]);
    return true;
}

function logoutUser() {
    unsetSession("user");
}
