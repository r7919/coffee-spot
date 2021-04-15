<?php

require_once('../shared/initialize.php');

require_login();

if(is_post_request()) {

  $coffee = [];
  $coffee['coffee_name'] = $_POST['coffee_name'] ?? '';
  $coffee['coffee_price'] = $_POST['coffee_price'] ?? '';
  $coffee['cook_time'] = $_POST['cook_time'] ?? '';
  $coffee['trend_val'] = $_POST['trend_val'] ?? '';

  $result = insert_coffee($coffee);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The new coffee was created successfully.'; // _session message
    redirect_to(url_for('/coffees/show.php?id=' . $new_id)); // if post redirect to show
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $coffee = [];
  $coffee['coffee_name'] = '';
  $coffee['coffee_price'] = '';
  $coffee['cook_time'] = '';
  $coffee['trend_val'] = '';
}

?>

<?php $page_title = 'Add Coffee'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/coffees/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Add Coffee</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/coffees/new.php'); ?>" method="post">
      <dl>
        <dt>Coffee Name</dt>
        <dd><input type="text" name="coffee_name" value="<?php echo h($coffee['coffee_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Coffee Price</dt>
        <dd><input type="number" name="coffee_price" value="<?php echo h($coffee['coffee_price']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Cook Time</dt>
        <dd><input type="number" name="cook_time" value="<?php echo h($coffee['cook_time']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Trend Value</dt>
        <dd><input type="number" name="trend_val" value="<?php echo h($coffee['trend_val']); ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Add Coffee" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
