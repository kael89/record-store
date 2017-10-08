<?php
// Define constants
define("ROOT_FOLDER", "record-store/");
// Max file size: 1MB
define("MAX_FILE_SIZE", 1048576);

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

/*** URL ***/
function getUrlPath() {
    return str_replace("/" . ROOT_FOLDER, "", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
}

/*** FILE REFERENCE ***/
function getFilePath($path) {
    return $_SERVER["DOCUMENT_ROOT"] . "/record-store/$path"; 
}

function getImageDir($type, $category, $size = "sm") {
    return getFilePath("img/$type/$category/$size");
}

function getImageSrc($type, $category, $size, $name) {
    $imagePath = getImageDir($type, $category, $size) . "/$name";
    $lastModified = filemtime($imagePath);
    return "/record-store/img/$type/$category/$size/$name?=$lastModified";
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

function uploadImage($file, $type, $cat, $size, $newName = "") {
    if ($file["error"] != UPLOAD_ERR_OK) {
        return "";
    }

    $targetDir = getImageDir($type, $cat, $size);
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
    $params = array(getParams($table, $columns));

    $query = "INSERT INTO $table(" . implode(',', $columns) . ")" . " VALUES(" . str_repeat("?,", count($values));
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
    return $mysqli->add_id;
}

function updateRows($table, $row, $where) {
    $mysqli = getSession("mysqli");
    $columns = array_keys($row);
    $values = array_values($row);
    $params = getParams($table, $columns) . getParams($table, array_keys($where));
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

    $args = array_merge(array($params), $values);
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

function getRows($table, $columns, $joins = [], $distinct = false, $append = "") {
    $mysqli = getSession("mysqli");

    $select = "SELECT ";
    if ($distinct) {
        $select .= "DISTINCT ";
    }
    //JOIN
    $join = "";
    foreach($joins as $joinTable => $condition) {
        $join .= " JOIN $joinTable ON $condition AND $joinTable.deleted=FALSE";
    }

    //WHERE
    $where = " WHERE $table.deleted=FALSE";
    foreach($columns as $column => $condition) {
        $select .= "$column,";
        if ($condition !== "") {
            $where .= " AND ($column" . "$condition)";
        }
    }

    $query = rtrim($select, ",") . " FROM $table $join $where $append";
    // Debug DB query
    // consoleLog($query);
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
