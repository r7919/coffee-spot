<?php

require_once('../shared/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/meds/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {
  
  $medicine = [];
  $medicine['medicine_id'] = $id ?? '';
  $medicine['medicine_name'] = $_POST['medicine_name'] ?? '';
  $medicine['medicine_price'] = $_POST['medicine_price'] ?? '';

  $result = update_medicine($medicine);
  
  if($result === true) {
    $_SESSION['message'] = 'The medicine was updated successfully.';
    redirect_to(url_for('/meds/show.php?id=' . $id));
  } else {
    $errors = $result;
  }

} else {
  $medicine = find_medicine_by_id($id);
}

?>

<?php $page_title = 'Edit Medicine'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/meds/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject edit">
    <h1>Edit Medicine</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/meds/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Medicine Name</dt>
        <dd><input type="text" name="medicine_name" value="<?php echo h($medicine['medicine_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Medicine Price</dt>
        <dd><input type="number" name="medicine_price" value="<?php echo h($medicine['medicine_price']); ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Medicine" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
