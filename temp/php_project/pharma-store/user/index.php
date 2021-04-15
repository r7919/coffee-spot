<?php require_once('shared/initialize.php'); ?>

<?php require_login(); ?>

<?php $page_title = 'User Menu'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>
<div class="row">
    <div class="column" style="width: 40%;">
      <div id="contentt">
        <div id="main-menu">
          <h2>Main Menu</h2>
          <ul>
            <li><a href="<?php echo url_for('/orders/index.php'); ?>">Orders</a></li>
            <br />
          </ul>
        </div>
      </div>
    </div>

    <?php $medicine_set = find_all_medicines(); ?>
    
    <div class="column">
      <div id="content">
        <div class="pages listing">
          <h2>~ Available Medicines ~</h2>
          <table class="list" style="width: 60%;">
            <tr>
              <th>Name</th>
              <th>Price</th>
            </tr>
            <?php while($medicine = mysqli_fetch_assoc($medicine_set)) { ?>
              <tr>
                <td><?php echo h($medicine['medicine_name']); ?></td>
                <td><?php echo h($medicine['medicine_price']); ?></td>
              </tr>
            <?php } ?>
          </table>
          <?php mysqli_free_result($medicine_set); ?>
        </div>
      </div>
    </div>
</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
