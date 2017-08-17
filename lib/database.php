<?php
/* Main */
require_once "library.php";

if (!isset($mysqli)) {
    $mysqli = connectToDB(); 
}

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
    case "user_login":
        $email = getPost("email");
        $password = getPost("password");
        require_once "classes/User.php";

        if (User::login($email, $password)) {
            echo "true";
        };
        break;
    default:
        break;
}
/********/

function connectToDB() {
    $hostname = "localhost";
    $username = "root";
    $password = "kkzara2017!";
    $database = "record_store";

    $mysqli = new mysqli($hostname, $username, $password, $database);
    setSession(["mysqli" => $mysqli]);
    return $mysqli;
}

//!!Refactor to use variable length of $values. Currently 6 values supported
/* $row = array('columnName' => 'value') */
function insertRow($table, $row, $param) {
    $mysqli = getSession("mysqli");
    $columns = array_keys($row);
    $values = array_values($row);
    $numValues = count($values);

    $query = "INSERT INTO $table(" . implode(',', $columns) . ")" . "VALUES(" . str_repeat("?,", $numValues);
    $query = rtrim($query, ",") . ")";

    $stmt = $mysqli->prepare($query);
    switch ($numValues) {
        case 0:
            return 0;
            break;
        case 1:
            $stmt->bind_param($param, $values[0]);
            break;
        case 2:
            $stmt->bind_param($param, $values[0], $values[1]);
            break;
        case 3:
            $stmt->bind_param($param, $values[0], $values[1], $values[2]);
            break;
        case 4:
            $stmt->bind_param($param, $values[0], $values[1], $values[2], $values[3]);
            break;
        case 5:
            $stmt->bind_param($param, $values[0], $values[1], $values[2], $values[3], $values[4]);
            break;
        case 6:
            $stmt->bind_param($param, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5]);
            break;
    }
    $stmt->execute();
    $stmt->close();

    return $mysqli->insert_id;
}

function getRows($table, $columns, $joins = [], $append = "") {
    $mysqli = getSession("mysqli");
    $query = "";
    $result = [];
    $rows = [];

    $select = "SELECT ";
    //JOIN
    $join = "";
    foreach($joins as $joinTable => $condition) {
        $join .= " JOIN $joinTable ON $condition";
    }

    //WHERE
    $where = "WHERE (TRUE)";
    foreach($columns as $column => $condition) {
        $select .= "$column,";
        if ($condition !== "") {
            $where .= " AND ($column" . "$condition)";
        }
    }

    $query = rtrim($select, ",") . " FROM $table $join $where $append";
    $result = $mysqli->query($query);
    if (!$result) {
        return;
    }

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}