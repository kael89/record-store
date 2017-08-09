<?php

class User {
    const salt = "v$%2";
    const table = "users";

    private $id;
    private $firstName;
    private $lastName;
    private $email;

    public function getFirstName() { 
        return $this->firstName;
    }

    public function __construct($firstName, $lastName, $email, $password) {
        $row = [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "password" => hash("sha256", $password . User::salt),
            "admin" => "FALSE"
        ];
        $param = "ssssi";

        $this->id = insertRow(User::table, $row, $param);
        if ($this->id < 0) {
            die ("Database error: Could not create user; Duplicate entry?");
        }
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public static function validate($email, $password) {
        $columns = [
            "userId" => "",
            "firstName" => "",
            "lastName" => "",
            "email" => "='$email'",
            "password" => "='" . hash("sha256", $password . User::salt) . "'",
            "admin" => ""
        ];

        $user = getRows(User::table, $columns)[0];
        if ($user) {
            return new User($user['firstName'], $user['lastName'], $user['email'], $user['password']);
        }
    }

    public static function logout() {
        unsetSession("user");
    }
}