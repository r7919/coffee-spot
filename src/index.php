<?php

  $cs_end = strpos($_SERVER['SCRIPT_NAME'], '/coffee-spot') + 12;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $cs_end);
  define("WWW_CS", $doc_root);

  $location = WWW_CS . "/user/login.php";

  header("Location: " . $location);
  exit;

?>