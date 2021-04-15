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
  $medicine['medicine_qty'] = $_POST['medicine_qty'] ?? 0;
  $medicine['stock_alert'] = 'sufficient';

  $result = add_supply_medicine($medicine);
  
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

<?php $page_title = 'Add Supply'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/meds/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject supply">
    <h1>Add supply to <?php echo h($medicine['medicine_name']) ?> </h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/meds/supply.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Increment Quantitiy</dt>
        <dd><input type="number" name="medicine_qty" value="0" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Add Quantity" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
