<?php 

require_once('../shared/initialize.php');

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

$user_id = get_user_id($username);

$orders_set = find_all_user_orders($user_id);
$orders_array = [];

while ($order = mysqli_fetch_assoc($orders_set)) {
    $current = []; 
    $current['id'] = (int) $order['id'];
    $current['ordered_at'] = $order['ordered_at'];
    $current['coffee_name'] = $order['coffee_name'];
    $current['price'] = (int) get_coffee_price($order['coffee_id']);
    $current['quantity'] = (int) $order['quantity'];
    $current['net_price'] = (int) $order['quantity'] * (int) get_coffee_price($order['coffee_id']);
    $current['status'] = $order['order_status'];
    $orders_array[] = $current;
}

echo json_encode($orders_array);

mysqli_free_result($orders_set); 

db_disconnect($db);

?>