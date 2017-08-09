<?php
/* Main */
require_once "general.php";

if (!isset($mysqli)) {
    $mysqli = connectToDB(); 
}

switch (getGet("action")) {
    case "get_rows":
        $table = getPost("table");
        $columns = getPost("columns");
        $append = getPost("append");

        if (isset($append)) {
            $result = getRows($table, $columns, $append);
        } else {
            $result = getRows($table, $columns);
        }

        echo json_encode($result);
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

    $numRows = $stmt->affected_rows;
    $stmt->close();

    return $numRows;
}

function getRows($table, $columns, $append = "") {
    $mysqli = getSession("mysqli");
    $result = [];
    $rows = [];
    $where = "WHERE (TRUE)";

    $query = "SELECT ";
    foreach($columns as $column => $condition) {
        $query .= "$column,";
        if ($condition !== "") {
            $where .= " AND ($column" . "$condition)";
        }
    }
    $query = rtrim($query, ",") . " FROM $table $where $append";
    $result = $mysqli->query($query);
    if (!$result) {
        die("Database connection error");
    }

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;var_dump($row);
    }
 die;
    return $rows;
}