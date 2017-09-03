<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";

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

    public function __construct($id, $firstName, $lastName, $email, $password) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public static function store($firstName, $lastName, $email, $password, $admin = "FALSE") {
        $row = [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "password" => hash("sha256", $password . User::salt),
            "admin" => $admin
        ];

        return insertRow(User::table, $row);
    }

    public static function login($email, $password) {
        $columns = [
            "userId" => "",
            "firstName" => "",
            "lastName" => "",
            "email" => "='$email'",
            "password" => "='" . hash("sha256", $password . User::salt) . "'",
            "admin" => ""
        ];

        $result = getRows(User::table, $columns);
        if (!empty($result)) {
            $user = $result[0];
            return new User($user['userId'], $user['firstName'], $user['lastName'], $user['email'], $user['password']);
        }
    }

    public static function logout() {
        unsetSession("user");
    }
}