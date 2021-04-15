<?php

require_once('../shared/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/meds/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_medicine($id);
  $_SESSION['message'] = 'The medicine was deleted successfully.';
  redirect_to(url_for('/meds/index.php'));

} else {
  $medicine = find_medicine_by_id($id);
}

?>

<?php $page_title = 'Delete Medicine'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/meds/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject delete">
    <h1>Delete Medicine</h1>
    <p>Are you sure you want to delete this medicine?</p>
    <p class="item"><?php echo h($medicine['medicine_name']); ?></p>

    <form action="<?php echo url_for('/meds/delete.php?id=' . h(u($medicine['medicine_id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Medicine" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
