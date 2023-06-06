<?php

function get_public_url($path = "/") {
    if($path[0] != '/') {
        $path = '/' . $path;
    }
    return WWW_ROOT . '/public' . $path;
}

function get_path($path = "/") {
    if($path[0] != '/') {
        $path = '/' . $path;
    }
    return PROJECT_ROOT . $path;
}

function redirect($path) {
    header('Location: ' . get_public_url($path) );
}

function h($str) {
    return htmlspecialchars($str);
}

function u($string) {
    return urlencode($string);
}

function is_blank($var) {
    if(!isset($var) || "" === trim($var, " ") ) {
        return true;
    } 
    return false;
}

function wrap_pre($data) {
    return '<pre>' . print_r($data,true) . '</pre>';
}

function dd($data) {
    echo wrap_pre($data);
    die();
}


// Create database connection function
function db_connect() {
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if($db->connect_errno) {
        echo "Failed to connect to MySQL" . $db->connect_error;
        die();
    }
    return $db;
}
