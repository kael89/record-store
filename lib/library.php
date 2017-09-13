<?php

if (!isset($mysqli)) {
    $mysqli = connectToDB(); 
}

/*** DEBUG ***/
function consoleLog() {
    $args = func_get_args();
    
    foreach ($args as $arg) {
        echo "<script>console.log(" . json_encode($arg) . ")</script>";
    }
}

/*** FILE REFERENCE ***/
function getPath($path) {
    return $_SERVER["DOCUMENT_ROOT"] . "/record-store/$path"; 
}

function getImage($type, $category, $name = "", $size = "sm") {
    $sizes = [
        "sm",
        "md",
        "lg"
    ];

    if (!in_array($size, $sizes)) {
        $size = "sm";
    }
    return "/record-store/img/$type/$category/$size/$name";
}

function requirePhp($type, $name = "") {
    // Tables for file categories that can be included as a whole
    $api = [
        "artist" => "lib/api/artist-api.php",
        "genre" => "lib/api/genre-api.php",
        "label" => "lib/api/label-api.php",
        "record" => "lib/api/record-api.php",
        "track" => "lib/api/track-api.php",
        "user" => "lib/api/user-api.php"
    ];
    $class = [
        "artist" => "lib/classes/Artist.php",
        "genre" => "lib/classes/Genre.php",
        "label" => "lib/classes/Label.php",
        "record" => "lib/classes/Record.php",
        "track" => "lib/classes/Track.php",
        "user" => "lib/classes/User.php"
    ];

    $filepaths = [];
    $arr = [];
    switch ($type) {
        // Back-end functionality
        case "api":
        case "class":
            $arr = $$type;
            if ($name == "") {
                $filepaths = $arr;
            } else {
                $filepaths[] = getPath($arr[$name]);
            }
            break;
        case "template":
            $filepaths[] = getPath("templates/$name.php");
            break;
        case "page": 
            $filepaths[] = getPath("pages/$name.php");
            break;
        case "tables":
            $filepaths[] = getPath("lib/tables.php");
            break;
        case "file":
        default:
            $filepaths[] = getPath($name);
            break;
    }

    // If $filepaths[] contains more than 1 element,
    // it is a given array with valid data
    if (count($filepaths) > 1) {
        foreach ($filepaths as $key => $path) {
            require_once getPath($path);
        }
    } else {
        if (!file_exists($filepaths[0])) {
            return false;
        }
        require_once $filepaths[0];
    }

    return true;
}

/*** $_POST, $_GET ***/
function getGet($var) {
    if (isset($_GET[$var])) {
        return $_GET[$var];
    }
}

function getPost($var) {
    if (isset($_POST[$var])) {
        return $_POST[$var];
    }
}

/*** $_SESSION ***/
function startSession() {
    requirePhp("class", "user");
    session_start();
}

function setSession($vars) {
    if (!isset($_SESSION)) {
        startSession();
    }

    foreach ($vars as $key => $val) {
        $_SESSION[$key] = $val;
    }
}

function getSession($var) {
    if (!isset($_SESSION)) {
        startSession();
    }

    if (isset($_SESSION[$var])) {
        return $_SESSION[$var];
    }
}

function unsetSession($var) {
    if (!isset($_SESSION)) {
        startSession();
    }

    unset($_SESSION[$var]);
}

/*** DATABASE ***/
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

/*** ENCRYPTION ***/
function getSalted($str) {
    return hash("sha256", $str . "v$%2");
}
