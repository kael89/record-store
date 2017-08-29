<?php
/* Main */
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/tables.php";

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

// $row = assoc_array('column' => 'value')
function insertRow($table, $row) {
    $mysqli = getSession("mysqli");
    $columns = array_keys($row);
    $values = array_values($row);
    $params = array(getParams($table, $columns));

    $query = "INSERT INTO $table(" . implode(',', $columns) . ")" . "VALUES(" . str_repeat("?,", count($values));
    $query = rtrim($query, ",") . ")";
    $stmt = $mysqli->prepare($query);

    $args = array_merge($params, $values);
    foreach (array_keys($args) as $i) {
        $args[$i] =& $args[$i];
    }
    $ref = new ReflectionClass("mysqli_stmt");
    $method = $ref->getMethod("bind_param");
    $method->invokeArgs($stmt, $args);

    $stmt->execute();
    $stmt->close();
    return $mysqli->insert_id;
}

function updateRow($table, $row, $where) {
    $mysqli = getSession("mysqli");
    $columns = array_keys($row);
    $values = array_values($row);
    $params = getParams($table, $columns);

    //SET
    $query = "UPDATE $table SET ";
    foreach ($columns as $column) {
        $query .= $column . "=?,";
    }

    //WHERE
    $query = rtrim($query, ",") . " WHERE (TRUE)";
    foreach ($where as $column => $value) {
        $query .= " AND $column ?";

        $values[] = $value;
        $columnName = array_slice(explode(' ', $column), 0, 1);
        $params .= getParams($table, $columnName);
    }

    $stmt = $mysqli->prepare($query);
    if (!$stmt) {
        return false;
    }

    $args = array_merge(array($params), $values);
    foreach (array_keys($args) as $i) {
        $args[$i] =& $args[$i];
    }
    $ref = new ReflectionClass("mysqli_stmt");
    $method = $ref->getMethod("bind_param");
    $method->invokeArgs($stmt, $args);

    $stmt->execute();
    $stmt->close();
    return true;
}

function getRows($table, $columns, $joins = [], $distinct = false, $append = "") {
    $mysqli = getSession("mysqli");

    $select = "SELECT ";
    if ($distinct) {
        $select .= "DISTINCT ";
    }
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

    $query = rtrim($select, ",") . " FROM $table $join $where $append"; //consoleLog($query);
    $result = $mysqli->query($query);

    $rows = [];
    if (!$result) {
        return $rows;
    }
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}

function isRow($table, $column, $value) {
    $mysqli = getSession("mysqli");

    $query = "SELECT $column FROM $table WHERE $column = $value";
    $result = $mysqli->query($query);

    return $result->num_rows;
}