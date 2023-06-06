<?php

//output buffering
ob_start();

// define path constants
define('WWW_ROOT', 'http://localhost:8888');
define('PROJECT_ROOT', dirname(__DIR__, 1));

// define database constants
define('DB_HOST', 'localhost');
define('DB_USER', 'note_app_user');
define('DB_PASS', '#ksj23Q!');
define('DB_DATABASE', 'note_app');

// get functions.php
require('functions.php');

// import class data
require_once(get_path('app/Classes/Note.php'));
require_once(get_path('app/Classes/User.php'));
require_once(get_path('app/Classes/Session.php'));

// connect database with the function created on functions.php
$db = db_connect();

// Initialize the session
$session = new Session();

// Run a static method of Note class to pass the database to connection
Note::set_db($db);
User::set_db($db);