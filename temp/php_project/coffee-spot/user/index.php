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
            <li><a href="<?php echo url_for('/spots/index.php'); ?>">Spots</a></li>
            <br />
            <li><a href="<?php echo url_for('/orders/index.php'); ?>">Orders</a></li>
            <br />
          </ul>
        </div>
      </div>
    </div>

    <?php $trending_set = find_all_trending(); ?>
    
    <div class="column">
      <div id="content">
        <div class="pages listing">
          <h2>~ Trending ~</h2>
          <table class="list" style="width: 60%;">
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
          <?php mysqli_free_result($trending_set); ?>
        </div>
      </div>
    </div>
</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
