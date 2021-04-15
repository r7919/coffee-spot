<?php

require_once('shared/initialize.php');

$errors = [];
$username = $_GET['username'] ?? '';
$password = $_GET['password'] ?? '';

// Validations
if(is_blank($username)) {
  $errors[] = "Username cannot be blank.";
}
if(is_blank($password)) {
  $errors[] = "Password cannot be blank.";
}

// if there were no errors, try to login
if(empty($errors)) {
  $user = find_user_by_username($username);
  if($user) {
    if(!password_verify($password, $user['hashed_password'])) {
      $errors[] = "Log in was unsuccessful.";
    }
  } else {
    $errors[] = "Log in was unsuccessful.";
  }
}

$errors_string = json_encode($errors);

echo $errors_string;

db_disconnect($db);

?>
