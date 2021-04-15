<?php require_once('../shared/initialize.php'); ?>

<?php
  require_login();
?>

<?php $page_title = 'Orders'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

<div id="content">
  <div class="pages listing">

    <h1>Orders</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/orders/new.php'); ?>">Order Medicines</a>
    </div>
    
  	<table class="list">
  	  <tr>
        <th>Order ID</th>
        <th>Ordered at</th>
        <th>Medicine Name</th>
        <th>Medicine Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php 
      $orders_set = find_all_user_orders_();
      while($order = mysqli_fetch_assoc($orders_set)) { ?>
        <tr>
          <td><?php echo h($order['id']); ?></td>
          <td><?php echo h($order['ordered_at']); ?></td>
          <td><?php echo h($order['medicine_name']); ?></td>
          <td><?php echo get_medicine_price($order['medicine_id']); ?></td>
          <td><?php echo h($order['quantity']); ?></td>
          <td><?php echo (int) $order['quantity'] * (int) get_medicine_price($order['medicine_id']); ?></td>
          <td><?php echo h($order['order_status']); ?></td>
          <td><a class="action" href="<?php echo url_for('/orders/show.php?id=' . h(u($order['employee_id']))); ?>">Delivery Employee details</a></td>
    	</tr>
      <?php } ?>
  	</table>
    <?php mysqli_free_result($orders_set); ?>

    <br /> <br />

  </div>
</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
