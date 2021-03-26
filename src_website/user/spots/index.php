<?php require_once('../shared/initialize.php'); ?>

<?php

  require_login();

  sync_spots();

  $spots_set = find_all_user_reservations();
  
?>

<?php $page_title = 'Spots'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

<div id="content">
  <div class="pages listing">
    <h1>Spots</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/spots/new.php'); ?>">Book a new spot</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>Spot ID</th>
        <th>Reservation Status</th>
        <th>Start Time</th>
        <th>End Time</th>
  	  </tr>

      <?php while($spot = mysqli_fetch_assoc($spots_set)) { ?>
        <tr>
          <td><?php echo h($spot['spot_id']); ?></td>
          <td>
              <?php 
                if (((int) strtotime($spot['end_time'])) >= ((int) (time())))
                  echo "Active";
                else
                  echo "Expired";
              ?>
          </td>
          <td><?php echo h($spot['start_time']); ?></td>
          <td><?php echo h($spot['end_time']); ?></td>
    	</tr>
      <?php } ?>
  	</table>
      <?php
        mysqli_free_result($spots_set);
      ?>
  </div>
</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
