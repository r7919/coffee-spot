<?php require_once('../shared/initialize.php'); ?>

<?php

  require_login();

  $price_set = find_all_prices();
  
?>

<?php $page_title = 'Spot Prices'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div class="pages listing">
    <h1>Spot Prices</h1>

  	<table class="list">
  	  <tr>
        <th>Spot Type</th>
        <th>Base Price</th>
        <th>Increment Price</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($price = mysqli_fetch_assoc($price_set)) { ?>
        <tr>
          <td><?php echo h($price['spot_type']); ?></td>
          <td><?php echo h($price['base_price']); ?></td>
          <td><?php echo h($price['incr_price']); ?></td>
          <td><a class="action" href="<?php echo url_for('/spot_price/edit.php?type=' . h(u($price['spot_type']))); ?>">Edit</a></td>
    	  </tr>
      <?php } ?>
  	</table>
      <?php
        mysqli_free_result($price_set);
      ?>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
