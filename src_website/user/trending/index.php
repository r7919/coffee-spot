<?php require_once('../shared/initialize.php'); ?>

<?php

  require_login();

  $trending_set = find_all_trending();
  
?>

<?php $page_title = 'Trending Coffees'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Back to Main Menu</a>

  <div class="pages listing">
    <h1>~ Trending ~</h1>
    
  	<table class="list">
  	  <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Cook Time (min.)</th>
  	    <th>Trend Value</th>
  	  </tr>

      <?php while($coffee = mysqli_fetch_assoc($trending_set)) { ?>
        <tr>
          <td><?php echo h($coffee['coffee_name']); ?></td>
          <td><?php echo h($coffee['coffee_price']); ?></td>
    	    <td><?php echo h($coffee['cook_time']); ?></td>
          <td><?php echo h($coffee['trend_val']); ?></td>
    	  </tr>
      <?php } ?>
  	</table>

      <?php
        mysqli_free_result($trending_set);
      ?>

  </div>

</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
