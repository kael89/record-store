<?php

function consoleLog($var) {
    echo "<script>";
    echo "console.log(" . json_encode($var) . ")";
    echo "</script>";
}

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

function setSession($vars) {
    if (!isset($_SESSION)) {
        session_start();
    }

    foreach ($vars as $key => $val) {
        $_SESSION[$key] = $val;
    }
}

function getSession($var) {
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION[$var])) {
        return $_SESSION[$var];
    }
}

function unsetSession($var) {
    if (!isset($_SESSION)) {
        session_start();
    }

    unset($_SESSION[$var]);
}
