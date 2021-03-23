<?php
  ob_start();      // output buffering is turned on

  session_start(); // turn on sessions

  // file path
  define("SHARED_PATH", dirname(__FILE__));
  define("USER_PATH", dirname(SHARED_PATH));

  // user www path
  $user_end = strpos($_SERVER['SCRIPT_NAME'], '/user') + 5;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $user_end);
  define("WWW_USER", $doc_root);

  require_once('functions.php');
  require_once('database.php');
  require_once('query_functions.php');
  require_once('validation_functions.php');
  require_once('auth_functions.php');

  $db = db_connect();
  $errors = [];

?>