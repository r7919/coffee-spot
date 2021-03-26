<?php
  ob_start();      // output buffering is turned on

  session_start(); // turn on sessions

  // file path
  define("SHARED_PATH", dirname(__FILE__));
  define("EMPLOYEE_PATH", dirname(SHARED_PATH));

  // employee www path
  $employee_end = strpos($_SERVER['SCRIPT_NAME'], '/employee') + 9;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $employee_end);
  define("WWW_EMPLOYEE", $doc_root);

  require_once('functions.php');
  require_once('database.php');
  require_once('query_functions.php');
  require_once('validation_functions.php');
  require_once('auth_functions.php');

  $db = db_connect();
  $errors = [];

?>