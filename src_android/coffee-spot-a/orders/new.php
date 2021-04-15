<?php

require_once('../shared/initialize.php');

$coffee_set = find_all_coffees(); 
$coffee_array = [];
$errors = [];
$username = $_GET['username'] ?? '';

if(is_blank($username)) {
  echo "Username cannot be blank.";
  exit;
}

$user = find_user_by_username($username);
if (!$user) {
  echo "User does not exist";
  exit;
}

$cnt = 1;

while($coffee = mysqli_fetch_assoc($coffee_set)) {
  $coffee_array[$cnt] = $coffee;
  $cnt++;
}

$c_count = $cnt - 1;

$order_qty = [];

for ($i = 1; $i <= $c_count; $i++) {
  if (!isset($_GET["{$i}"])) {
    $order_qty[$i] = 0;
    continue;
  }

  $order_qty[$i] = (int) $_GET["{$i}"];
}

$user_id = get_user_id($username);

$result = insert_orders($coffee_array, $c_count, $order_qty, $user_id);

if($result === true) {
  $errors = [];
} else {
  $errors = $result;
}

echo json_encode($errors);

mysqli_free_result($coffee_set); 

db_disconnect($db);

?>