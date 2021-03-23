<?php require_once('../shared/initialize.php'); ?>

<?php

  require_login();

  $coffee_set = find_all_coffees();
  
?>

<?php $page_title = 'Coffees'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div class="pages listing">
    <h1>Coffees</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/coffees/new.php'); ?>">Add New Coffee</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Cook Time (min.)</th>
  	    <th>Trend Value</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($coffee = mysqli_fetch_assoc($coffee_set)) { ?>
        <tr>
          <td><?php echo h($coffee['coffee_id']); ?></td>
          <td><?php echo h($coffee['coffee_name']); ?></td>
          <td><?php echo h($coffee['coffee_price']); ?></td>
    	  <td><?php echo h($coffee['cook_time']); ?></td>
          <td><?php echo h($coffee['trend_val']); ?></td>
          <td><a class="action" href="<?php echo url_for('/coffees/show.php?id=' . h(u($coffee['coffee_id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/coffees/edit.php?id=' . h(u($coffee['coffee_id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/coffees/delete.php?id=' . h(u($coffee['coffee_id']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>
      <?php
        mysqli_free_result($coffee_set);
      ?>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
