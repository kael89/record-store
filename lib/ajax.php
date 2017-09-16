<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("tables");
requirePhp("api", "record");
requirePhp("api", "user");
requirePhp("classes", "user");

switch (getGet("action")) {
    case "get_rows":
        $table = getPost("table");
        $columns = getPost("columns");
        $append = getPost("append");

        $result = (isset($append)) ? getRows($table, $columns, $append) : getRows($table, $columns);
        if ($result) {
            echo json_encode($result);
        }
        break;
    case "login":
        $email = getPost("email");
        $password = getPost("password");

        echo json_encode(loginUser($email, $password));
        break;
    default:
        break;
}