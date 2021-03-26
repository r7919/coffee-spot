<?php

require_once('../shared/initialize.php');

require_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/orders/index.php'));
}

$id = $_GET['id'];

$result = update_order_status($id);
  
if($result === true) {
  $_SESSION['message'] = 'The coffee was delivered successfully.';
  redirect_to(url_for('/orders/index.php'));
} else {
  $errors = $result;
  redirect_to(url_for('/orders/index.php'));
}

?>