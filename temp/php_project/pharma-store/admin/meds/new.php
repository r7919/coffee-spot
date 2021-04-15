<?php

require_once('../shared/initialize.php');

require_login();

if(is_post_request()) {

  $medicine = [];
  $medicine['medicine_name'] = $_POST['medicine_name'] ?? '';
  $medicine['medicine_price'] = $_POST['medicine_price'] ?? '';
  $medicine['stock_alert'] = 'needed';
  $medicine['medicine_qty'] = 0;

  $result = insert_medicine($medicine);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The new medicine was created successfully.'; // _session message
    redirect_to(url_for('/meds/show.php?id=' . $new_id)); // if post redirect to show
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $medicine = [];
  $medicine['medicine_name'] = '';
  $medicine['medicine_price'] = '';
}

?>

<?php $page_title = 'Add Medicine'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/meds/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Add Medicine</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/meds/new.php'); ?>" method="post">
      <dl>
        <dt>Medicine Name</dt>
        <dd><input type="text" name="medicine_name" value="<?php echo h($medicine['medicine_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Medicine Price</dt>
        <dd><input type="number" name="medicine_price" value="<?php echo h($medicine['medicine_price']); ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Add Medicine" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
