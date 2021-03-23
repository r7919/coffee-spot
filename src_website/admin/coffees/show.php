<?php require_once('../shared/initialize.php'); ?>

<?php

require_login();

$id = $_GET['id'] ?? '1'; 

$coffee = find_coffee_by_id($id);

?>

<?php $page_title = 'Show Coffee'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/coffees/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject show">

    <h1><?php echo h($coffee['coffee_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Price</dt>
        <dd><?php echo h($coffee['coffee_price']); ?></dd>
      </dl>
      <dl>
        <dt>Cook Time</dt>
        <dd><?php echo h($coffee['cook_time']); ?></dd>
      </dl>
      <dl>
        <dt>Trend Value</dt>
        <dd><?php echo h($coffee['trend_val']); ?></dd>
      </dl>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>