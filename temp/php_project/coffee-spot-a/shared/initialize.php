<?php
  ob_start();      // output buffering is turned on

  session_start(); // turn on sessions

  // file path
  define("SHARED_PATH", dirname(__FILE__));
  define("CSA_PATH", dirname(SHARED_PATH));

  // csa www path
  $csa_end = strpos($_SERVER['SCRIPT_NAME'], '/coffee-spot-a') + 14;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $csa_end);
  define("WWW_CSA", $doc_root);

  require_once('functions.php');
  require_once('database.php');
  require_once('query_functions.php');
  require_once('validation_functions.php');
  require_once('auth_functions.php');

  $db = db_connect();
  $errors = [];

?>