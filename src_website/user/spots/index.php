<?php require_once('../shared/initialize.php'); ?>

<?php

  require_login();

  sync_spots();
  
?>


<?php $page_title = 'Spots'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

<div id="content">
  <div class="pages listing">
    <h1>Spots</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/spots/new.php'); ?>">Book a new spot</a>
    </div>

    <h3>Current Bookings</h3>
  	<table class="list">
  	  <tr>
        <th>Spot Number</th>
        <th>Spot Type</th>
        <th>Reservation Status</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Price</th>
  	  </tr>

      <?php
        $spots_set = find_all_user_active_reservations(); 
        while($spot = mysqli_fetch_assoc($spots_set)) { 
      ?>
        <tr>
          <td><?php echo h($spot['spot_id']); ?></td>
          <td><?php echo find_type_by_spot_id(h($spot['spot_id'])); ?></td>
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
          <td><?php echo h(get_reservation_price($spot['id'])); ?></td>
    	</tr>
      <?php } ?>
  	</table>
    <?php mysqli_free_result($spots_set); ?>

    <br /> <br />

    <h3>Previous Bookings</h3>
    <table class="list">
  	  <tr>
        <th>Spot Number</th>
        <th>Spot Type</th>
        <th>Reservation Status</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Price</th>
  	  </tr>

      <?php
        $spots_set = find_all_user_expired_reservations(); 
        while($spot = mysqli_fetch_assoc($spots_set)) { 
      ?>
        <tr>
          <td><?php echo h($spot['spot_id']); ?></td>
          <td><?php echo find_type_by_spot_id(h($spot['spot_id'])); ?></td>
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
          <td><?php echo h(get_reservation_price($spot['id'])); ?></td>
    	</tr>
      <?php } ?>
  	</table>
    <?php mysqli_free_result($spots_set); ?>

    <br /> <br />

    <h3>Spot Prices</h3>
    <table class="list">
      <tr>
        <th>Spot Type</th>
        <th>Base Price</th>
        <th>Increment Price</th>
      </tr>

      <?php 
        $price_set = find_all_prices();
        while($price = mysqli_fetch_assoc($price_set)) { 
      ?>
        <tr>
          <td><?php echo h($price['spot_type']); ?></td>
          <td><?php echo h($price['base_price']); ?></td>
          <td><?php echo h($price['incr_price']); ?></td>
        </tr>
      <?php } ?>
    </table>
    <?php mysqli_free_result($price_set); ?>

    <br /> <br /> <br /> <br /> <br /> <br />

  </div>
</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
