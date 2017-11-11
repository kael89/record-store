<?php
// Define constants
// Max file size: 1MB
define("MAX_FILE_SIZE", 1048576);
// Code environment
define("CODE_ENV", "heroku");

if (!isset($mysqli)) {
    $mysqli = connectToDB(); 
}

/*** DEBUG ***/
// Debugging functions accept arbitrary number of arguments

function alert() {
    $args = func_get_args();
    
    foreach ($args as $arg) {
        echo "<script>window.alert(" . json_encode($arg) . ")</script>";
    }
}

function consoleLog() {
    $args = func_get_args();
    
    foreach ($args as $arg) {
        echo "<script>console.log(" . json_encode($arg) . ")</script>";
    }
}

function printR() {
    $args = func_get_args();

    echo '<pre>';
    foreach ($args as $arg) {
        print_r($arg);
    }
    echo '</pre>';
}

function varDump() {
    $args = func_get_args();

    echo '<pre>';
    foreach ($args as $arg) {
        var_dump($arg);
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
    $host = (CODE_ENV == "heroku") ? "https://s3-us-west-2.amazonaws.com/heroku-recordstore" : "";
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

function getId() {
    return (int)getGet("id");
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

/*** SANITIZE OUTPUT ***/
function outHtml($var) {
    return filter_var($var, FILTER_SANITIZE_STRING);
}

/*** DATABASE ***/
function connectToDB() {
    if (CODE_ENV == "heroku") {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

        $hostname = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $database = substr($url["path"], 1);
    } else {
        // Substitute those with your database credentials!
        $hostname = "localhost";
        $username = "root";
        $password = "root";
        $database = "record_store";
    }

    $mysqli = new mysqli($hostname, $username, $password, $database);
    setSession(["mysqli" => $mysqli]);
    return $mysqli;
}

function sql($query, $params, $values, $action = "select") {
    $mysqli = getSession("mysqli");

    // Debug DB query
    // consoleLog($query);
    $stmt = $mysqli->prepare($query);
    // if ($action == "select") varDump($args, $query);

    if ($values) {
        $args = array_merge((array)$params, $values);
        foreach (array_keys($args) as $i) {
            $args[$i] =& $args[$i];
        }

        $ref = new ReflectionClass("mysqli_stmt");
        $method = $ref->getMethod("bind_param");
        $method->invokeArgs($stmt, $args);
    }

    $stmt->execute();

    switch (strtolower($action)) {
        case "insert":
            $result = $mysqli->insert_id;
            break;
        case "update":
            $result = $mysqli->affected_rows;
            break;
        case "select":
            $result = $stmt->get_result();
        default:
            break;
    }

    $stmt->close();
    return $result;
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

    $str = rtrim($str, " AND ") ?: "TRUE";
    $params .= getParams($table, $columns);

    return $str;
}

// $row = assoc_array('column' => 'value')
function dbInsert($table, $row) {
    $mysqli = getSession("mysqli");
    $columns = array_keys($row);
    $params = getParams($table, $columns);
    $values = array_values($row);

    $query = "INSERT INTO $table(" . implode(",", $columns) . ")" . " VALUES(" . str_repeat("?,", count($values));
    $query = rtrim($query, ",") . ")";
    return sql($query, $params, $values, "insert");
}

function dbUpdate($table, $row, $conditions) {
    $mysqli = getSession("mysqli");
    $columns = array_keys($row);
    $values = array_values($row);
    $params = getParams($table, $columns);

    if (!$params) {
        return false;
    }

    //SET
    $query = "UPDATE $table SET ";
    foreach ($columns as $column) {
        $query .= $column . " = ?,";
    }
    $query = rtrim($query, ",");

    //WHERE
    $query .= " WHERE " . getConditions($table, $conditions, $values, $params);
    return sql($query, $params, $values, "update");
}

function dbSelect($table, $conditions = [], $joins = [], $distinct = false, $append = "") {
    $values = [];
    $params = "";

    // SELECT
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
    $result = sql($query, $params, $values);

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