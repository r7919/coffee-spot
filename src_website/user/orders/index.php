<?php require_once('../shared/initialize.php'); ?>

<?php

  require_login();

  $orders_set = find_all_user_orders();
  
?>

<?php $page_title = 'Orders'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

<div id="content">
  <div class="pages listing">
    <h1>Orders</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/orders/new.php'); ?>">Order a coffee</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>Order ID</th>
        <th>Ordered at</th>
        <th>Coffee Name</th>
        <th>Quantity</th>
        <th>Status</th>
  	  </tr>

      <?php while($order = mysqli_fetch_assoc($orders_set)) { ?>
        <tr>
          <td><?php echo h($order['id']); ?></td>
          <td><?php echo h($order['ordered_at']); ?></td>
          <td><?php echo h($order['coffee_name']); ?></td>
          <td><?php echo h($order['quantity']); ?></td>
          <td><?php echo h($order['order_status']); ?></td>
    	</tr>
      <?php } ?>
  	</table>
      <?php
        mysqli_free_result($orders_set);
      ?>
  </div>
</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
