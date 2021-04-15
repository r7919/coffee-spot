<?php

require_once('../shared/initialize.php');

require_login();

if(!isset($_GET['type'])) {
  redirect_to(url_for('/spot_price/index.php'));
}

$type = $_GET['type'];

if(is_post_request()) {
  
  $price = [];
  $price['spot_type'] = $type ?? '';
  $price['base_price'] = $_POST['base_price'] ?? '';
  $price['incr_price'] = $_POST['incr_price'] ?? '';

  $result = update_price($price);
  
  if($result === true) {
    $_SESSION['message'] = 'The spot price was updated successfully.';
    redirect_to(url_for('/spot_price/index.php'));
  } else {
    $errors = $result;
  }

} else {
  $price = find_price_by_type($type);
}

?>

<?php $page_title = 'Edit Spot Price'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/spot_price/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject edit">
    <h1>Edit Spot Price for <?php echo "'{$price['spot_type']}'"; ?> </h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/spot_price/edit.php?type=' . h(u($type))); ?>" method="post">
      <dl>
        <dt>Base Price</dt>
        <dd><input type="number" name="base_price" value="<?php echo h($price['base_price']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Increment Price</dt>
        <dd><input type="number" name="incr_price" value="<?php echo h($price['incr_price']); ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Update Price" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
