<?php

require_once('../shared/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/employees/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $employee = [];
  $employee['id'] = $id;
  $employee['first_name'] = $_POST['first_name'] ?? '';
  $employee['last_name'] = $_POST['last_name'] ?? '';
  $employee['email'] = $_POST['email'] ?? '';
  $employee['username'] = $_POST['username'] ?? '';
  $employee['password'] = $_POST['password'] ?? '';
  $employee['confirm_password'] = $_POST['confirm_password'] ?? '';

  $result = update_employee($employee);
  if($result === true) {
    $_SESSION['message'] = 'Employee updated.';
    redirect_to(url_for('/employees/show.php?id=' . $id));
  } else {
    $errors = $result;
  }
} else {
  $employee = find_employee_by_id($id);
}

?>

<?php $page_title = 'Edit Employee'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/index.php'); ?>">&laquo; Back to List</a>

  <div class="employee edit">
    <h1>Edit Employee</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employees/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>First name</dt>
        <dd><input type="text" name="first_name" value="<?php echo h($employee['first_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Last name</dt>
        <dd><input type="text" name="last_name" value="<?php echo h($employee['last_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="<?php echo h($employee['username']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo h($employee['email']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>
      </dl>

      <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd>
      </dl>
      <p>
        Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.
      </p>
      <br />

      <div id="operations">
        <input type="submit" value="Edit Employee" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
