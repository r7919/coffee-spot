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
      <a class="action" href="<?php echo url_for('/orders/new.php'); ?>">Order a coffee</a>
    </div>
    
    <h3>Preparing</h3>
  	<table class="list">
  	  <tr>
        <th>Order ID</th>
        <th>Ordered at</th>
        <th>Coffee Name</th>
        <th>Coffee Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Status</th>
  	  </tr>

      <?php 
      $orders_set = find_all_user_preparing_orders();
      while($order = mysqli_fetch_assoc($orders_set)) { ?>
        <tr>
          <td><?php echo h($order['id']); ?></td>
          <td><?php echo h($order['ordered_at']); ?></td>
          <td><?php echo h($order['coffee_name']); ?></td>
          <td><?php echo get_coffee_price($order['coffee_id']); ?></td>
          <td><?php echo h($order['quantity']); ?></td>
          <td><?php echo (int) $order['quantity'] * (int) get_coffee_price($order['coffee_id']); ?></td>
          <td><?php echo h($order['order_status']); ?></td>
    	</tr>
      <?php } ?>
  	</table>
    <?php mysqli_free_result($orders_set); ?>

    <br /> <br />

    <h3>Delivered</h3>
  	<table class="list">
  	  <tr>
        <th>Order ID</th>
        <th>Ordered at</th>
        <th>Coffee Name</th>
        <th>Coffee Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Status</th>
  	  </tr>

      <?php 
      $orders_set = find_all_user_delivered_orders();
      while($order = mysqli_fetch_assoc($orders_set)) { ?>
        <tr>
          <td><?php echo h($order['id']); ?></td>
          <td><?php echo h($order['ordered_at']); ?></td>
          <td><?php echo h($order['coffee_name']); ?></td>
          <td><?php echo get_coffee_price($order['coffee_id']); ?></td>
          <td><?php echo h($order['quantity']); ?></td>
          <td><?php echo (int) $order['quantity'] * (int) get_coffee_price($order['coffee_id']); ?></td>
          <td><?php echo h($order['order_status']); ?></td>
    	</tr>
      <?php } ?>
  	</table>
    <?php mysqli_free_result($orders_set); ?>

    <br /> <br />

    <h3>Available Coffees</h3>
    <table class="list">
  	  <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Cook Time (min.)</th>
  	    <th>Trend Value</th>
  	  </tr>

      <?php 
      $coffee_set = find_all_coffees();
      while($coffee = mysqli_fetch_assoc($coffee_set)) { ?>
        <tr>
          <td><?php echo h($coffee['coffee_id']); ?></td>
          <td><?php echo h($coffee['coffee_name']); ?></td>
          <td><?php echo h($coffee['coffee_price']); ?></td>
          <td><?php echo h($coffee['cook_time']); ?></td>
          <td><?php echo h($coffee['trend_val']); ?></td>
    	  </tr>
      <?php } ?>
  	</table>
    <?php mysqli_free_result($coffee_set); ?>

    <br /> <br /> <br /> <br /> <br /> <br />

  </div>
</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
