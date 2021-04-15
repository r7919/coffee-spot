<?php

require_once('../shared/initialize.php');

require_login();

$coffee_set = find_all_coffees(); 
$coffee_array = [];

$cnt = 1;

while($coffee = mysqli_fetch_assoc($coffee_set)) {
  $coffee_array[$cnt] = $coffee;
  $cnt++;
}

$c_count = $cnt - 1;

if(is_post_request()) {

  $order_qty = [];

  for ($i = 1; $i <= $c_count; $i++) {
    $order_qty[$i] = (int) $_POST["{$i}"];
  }

  $result = insert_orders($coffee_array, $c_count, $order_qty);
  
  if($result === true) {
    $_SESSION['message'] = 'Order was placed successfully.'; // _session message
    redirect_to(url_for('/orders/index.php')); // if post redirect to index.php
  } else {
    $errors = $result;
  }

} else {
  // display zeroes
  for ($i = 1; $i <= $c_count; $i++) {
    $order_qty[$i] = 0;
  }
}

?>

<?php $page_title = 'Order Coffee'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/orders/index.php'); ?>">&laquo; Back</a>

  <div class="order new">
    <h1>Order Coffee(s)</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/orders/new.php'); ?>" method="post">

      <table class="list">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Cook Time (min.)</th>
          <th>Quantity</th>
        </tr>

        <?php
         $cnt = 1;

         $coffee_set = find_all_coffees(); 

         while($coffee = mysqli_fetch_assoc($coffee_set)) { ?>
          <tr>
            <td><?php echo h($coffee['coffee_id']); ?></td>
            <td><?php echo h($coffee['coffee_name']); ?></td>
            <td><?php echo h($coffee['coffee_price']); ?></td>
            <td><?php echo h($coffee['cook_time']); ?></td>
            <td style="width: 20px;"><input type="number" name="<?php echo $cnt;?>" value="<?php echo $order_qty[$cnt];?>" /></td>
          </tr>
        <?php $cnt++; } ?>
      </table>

      <div id="operations">
        <input type="submit" value="Order" />
      </div>

    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
