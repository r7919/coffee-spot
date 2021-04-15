<?php

require_once('../shared/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/employees/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $result = delete_employee($id);
  $_SESSION['message'] = 'Employee deleted.';
  redirect_to(url_for('/employees/index.php'));
} else {
  $employee = find_employee_by_id($id);
}

?>

<?php $page_title = 'Delete Employee'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/index.php'); ?>">&laquo; Back to List</a>

  <div class="employee delete">
    <h1>Delete Employee</h1>
    <p>Are you sure you want to delete this employee?</p>
    <p class="item"><?php echo h($employee['username']); ?></p>

    <form action="<?php echo url_for('/employees/delete.php?id=' . h(u($employee['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Employee" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
