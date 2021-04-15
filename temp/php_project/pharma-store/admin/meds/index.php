<?php require_once('../shared/initialize.php'); ?>

<?php

  require_login();

  $medicine_set = find_all_medicines();
  
?>

<?php $page_title = 'Medicines'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div class="pages listing">
    <h1>Medicines</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/meds/new.php'); ?>">Add New Medicine</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantitiy</th>
  	    <th>Status</th>
        <th>&nbsp;</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($medicine = mysqli_fetch_assoc($medicine_set)) { ?>
        <tr>
          <td><?php echo h($medicine['medicine_id']); ?></td>
          <td><?php echo h($medicine['medicine_name']); ?></td>
          <td><?php echo h($medicine['medicine_price']); ?></td>
          <td><?php echo h($medicine['medicine_qty']); ?></td>
          <td><?php echo h($medicine['stock_alert']); ?></td>
          <td><a class="action" href="<?php echo url_for('/meds/supply.php?id=' . h(u($medicine['medicine_id']))); ?>">Order from supplier</a></td>
          <td><a class="action" href="<?php echo url_for('/meds/show.php?id=' . h(u($medicine['medicine_id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/meds/edit.php?id=' . h(u($medicine['medicine_id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/meds/delete.php?id=' . h(u($medicine['medicine_id']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>
      <?php
        mysqli_free_result($medicine_set);
      ?>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
