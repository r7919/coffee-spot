<?php

require_once('shared/initialize.php');

$errors = [];

$user = [];
$user['username'] = $_GET['username'] ?? '';
$user['password'] = $_GET['password'] ?? '';
$user['confirm_password'] = $_GET['confirm_password'] ?? '';

$result = insert_user($user);
if($result === true) {
  $errors = [];
} else {
  $errors = $result;
}

echo json_encode($errors);

?>