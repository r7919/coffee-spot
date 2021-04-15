<?php

  $ps_end = strpos($_SERVER['SCRIPT_NAME'], '/pharma-store') + 13;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $ps_end);
  define("WWW_PS", $doc_root);

  $location = WWW_PS . "/user/login.php";

  header("Location: " . $location);
  exit;

?>