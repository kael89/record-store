<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("tables");
requirePhp("api", "user");
requirePhp("class", "user");

function insertUser($firstName = "", $lastName = "", $email = "", $password = "", $admin = 0) {
    if ($firstName === "" || $lastName === "" || $email === "" || $password === "") {
        return null;
    }

    $row["firstName"] = $firstName;
    $row["lastName"] = $lastName;
    $row["email"] = $email;
    $row["password"] = getSalted($password);
    $row["admin"] = $admin;

    return dbInsert("users", $row);
}

function updateUser($id, $row) {
    if ($id < 1) {
        return false;
    }

    $conditions = [
        ["userId =", $id]
    ];
    
    return dbUpdate("users", $row, $conditions);
}

function getUser($email, $password) {
    if (empty($email) || empty($password)) {
        return null;
    }

    $conditions = [
        ["email =", $email],
        ["password =", getSalted($password)]
    ];
    $result = dbSelect("users", $conditions);

    if (!$result) {
        return false;
    }

    extract($result[0]);
    return new User($userId, $firstName, $lastName, $email, $password, $admin);
}