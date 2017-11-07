<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";

class User {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $admin;

    public function __construct($id, $firstName, $lastName, $email, $password, $admin) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->admin = $admin;
    }

    public static function create($firstName, $lastName, $email, $password, $admin = false) {
        $insertId = insertUser($firstName, $lastName, $email, $password);
        if (!$insertId) {
            return null;
        }

        return new User($insertId, $firstName, $lastName, $email, $password, $admin);
    }

    public function login() {
        setSession(["user" => $this]);
        setSession(["admin" => $this->getAdmin()]);
    }

    public function logout() {
        unsetSession("user");
        unsetSession("admin");
    }

    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }
}