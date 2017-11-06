<?php
// Define constants
// Max file size: 1MB
define("MAX_FILE_SIZE", 1048576);

if (!isset($mysqli)) {
    $mysqli = connectToDB(); 
}

/*** DEBUG ***/
// Accepts arbitrary number of arguments
function alert() {
    $args = func_get_args();
    
    foreach ($args as $arg) {
        echo "<script>window.alert(" . json_encode($arg) . ")</script>";
    }
}

// Accepts arbitrary number of arguments
function consoleLog() {
    $args = func_get_args();
    
    foreach ($args as $arg) {
        echo "<script>console.log(" . json_encode($arg) . ")</script>";
    }
}

// Accepts arbitrary number of arguments
function printVar() {
    $args = func_get_args();

    echo '<pre>';
    foreach ($args as $arg) {
        print_r($arg);
    }
    echo '</pre>';

}

/*** FILE REFERENCE ***/
function getFilePath($path) {
    return $_SERVER["DOCUMENT_ROOT"] . "/$path"; 
}

function getImageDir($type, $category) {
    return getFilePath("img/$type/$category");
}

function getImageSrc($type, $category, $name) {
    $imagePath = getImageDir($type, $category) . "/" . $name;
    $lastModified = filemtime($imagePath);
    return "/img/$type/$category/$name?=$lastModified";
}

function requirePhp($type, $name = "") {
    // Tables for file categories that can be included as a whole
    $api = [
        "artist" => "lib/api/artist-api.php",
        "genre" => "lib/api/genre-api.php",
        "record" => "lib/api/record-api.php",
        "track" => "lib/api/track-api.php",
        "user" => "lib/api/user-api.php"
    ];
    $class = [
        "artist" => "lib/classes/Artist.php",
        "genre" => "lib/classes/Genre.php",
        "record" => "lib/classes/Record.php",
        "track" => "lib/classes/Track.php",
        "user" => "lib/classes/User.php"
    ];
    $view = [
        "record" => "lib/view/record-view.php"
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
                $filepaths[] = getFilepath($arr[$name]);
            }
            break;
        case "template":
            $filepaths[] = getFilepath("templates/$name.php");
            break;
        case "page": 
            $filepaths[] = getFilepath("pages/$name.php");
            break;
        case "tables":
            $filepaths[] = getFilepath("lib/tables.php");
            break;
        case "view":
            $filepaths[] = getFilepath("lib/view.php");
            break;
        case "file":
        default:
            $filepaths[] = getFilepath($name);
            break;
    }

    // If $filepaths[] contains more than 1 element, it is a given array with valid data
    if (count($filepaths) > 1) {
        foreach ($filepaths as $key => $path) {
            require_once getFilepath($path);
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
    return isset($_GET[$var]) ? $_GET[$var] : null;
}

function getPost($var) {
    return isset($_POST[$var]) ? $_POST[$var] : null;
}

function getFile($var) {
    return isset($_FILE[$var]) ? $_FILE[$var] : null;
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

/*** FILE UPLOAD ***/
// Returns the filename of the uploaded file on success, or an empty string on failure
function uploadFile($file, $targetDir, $newName = "") {
    if ($file["error"] != UPLOAD_ERR_OK || $file["size"] > MAX_FILE_SIZE) {
        return "";
    }

    if ($newName) {
        $targetFile = $newName . "." . pathinfo($file["name"], PATHINFO_EXTENSION);
    } else {
        $targetFile = basename($file["name"]);
    }

    if (!move_uploaded_file($file["tmp_name"], "$targetDir/$targetFile")) {
        return "";
    }
    return $targetFile;
}

function uploadImage($file, $type, $cat, $newName = "") {
    if ($file["error"] != UPLOAD_ERR_OK) {
        return "";
    }

    $targetDir = getImageDir($type, $cat);
    return uploadFile($file, $targetDir, $newName);
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
    $params = getParams($table, $columns);

    $query = "INSERT INTO $table(" . implode(",", $columns) . ")" . " VALUES(" . str_repeat("?,", count($values));
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

function updateRows($table, $row, $where) {
    $mysqli = getSession("mysqli");
    $columns = array_keys($row);
    $values = array_values($row);
    $params = array_merge(getParams($table, $columns), getParams($table, array_keys($where)));

    if (!$params) {
        return false;
    }

    //SET
    $query = "UPDATE $table SET ";
    foreach ($columns as $column) {
        $query .= $column . "=?,";
    }

    //WHERE
    $query = rtrim($query, ",") . " WHERE (TRUE)";
    foreach ($where as $column => $value) {
        $query .= " AND ($column = ?)";
        $values[] = $value;
    }

    $stmt = $mysqli->prepare($query);
    if (!$stmt) {
        return false;
    }

    $args = array_merge($params, $values);
    foreach (array_keys($args) as $i) {
        $args[$i] =& $args[$i];
    }
    $ref = new ReflectionClass("mysqli_stmt");
    $method = $ref->getMethod("bind_param");
    $method->invokeArgs($stmt, $args);

    $stmt->execute();
    $updatedCount = $mysqli->affected_rows;
    $stmt->close();
    return $updatedCount;
}

function deleteRows($table, $where) {
    // Soft delete
    $row = ["deleted" => TRUE];
    return updateRows($table, $row, $where);
}

function getRows($table, $conditions = [], $joins = [], $distinct = false, $append = "") {
    $mysqli = getSession("mysqli");
    $values = [];
    $params = [];

    $select = "SELECT ";
    if ($distinct) {
        $select .= "DISTINCT ";
    }
    $select .= implode(",", getColumns($table));

    //JOIN
    $join = "";
    foreach($joins as $joinTable => $joinConditions) {
        $joinConditions[] = "$joinTable.deleted = FALSE";
        $join .= "JOIN $joinTable ON " . getConditions($joinTable, $joinConditions, $values, $params);
    }

    //WHERE
    $conditions[] = "$table.deleted = FALSE";
    $where = "WHERE " . getConditions($table, $conditions, $values, $params);

    $query = "$select FROM $table $join $where $append";
    // Debug DB query
    // consoleLog($query);
    $stmt = $mysqli->prepare($query);
    $args = array_merge($params, $values);
    foreach (array_keys($args) as $i) {
        $args[$i] =& $args[$i];
    }

    if ($args) {
        $ref = new ReflectionClass("mysqli_stmt");
        $method = $ref->getMethod("bind_param");
        $method->invokeArgs($stmt, $args);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $rows = [];
    if (!$result) {
        return $rows;
    }
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}

// Returns a conditional string for queries,
// and updates tables that are used in prepared statements
function getConditions($table, $conditions, &$values, &$params) {
    $columns = [];

    $str = "";
    foreach($conditions as $condition) {
        if (is_array($condition)) {
            $str .= "($condition[0] ?) AND ";
            $values[] = $condition[1];
            $columns[] = $condition[0];
        } else {
            $str .= "($condition) AND ";
        }
    }

    $params = array_merge($params, getParams($table, $columns));
    return rtrim($str, " AND ");
}

function isRow($table, $column, $value) {
    $mysqli = getSession("mysqli");

    $query = "SELECT $column FROM $table WHERE $column = $value";
    $result = $mysqli->query($query);
    return ($result) ? $result->num_rows : 0;
}

/*** ENCRYPTION ***/
function getSalted($str) {
    return hash("sha256", $str . "v$%2");
}

/*** PARSE DATA ***/
function parseDuration($duration) {
    // Convert mm:ss duration format to seconds
    $parts = explode(":", $duration);
    $parts = array_filter($parts, function($item) {
        return (is_numeric($item) && $item > 0);
    });

    $result = 0;
    if (count($parts) == 2) {
        $result = $parts[0] * 60 + $parts[1];
    } elseif (is_numeric($duration) && $duration > 0) {
        $result = $duration;
    }

    return $duration;
}

function parsePrice($price) {
    $price = preg_replace("/[^\d\.]/", "", $price);
    return floatval($price);
}