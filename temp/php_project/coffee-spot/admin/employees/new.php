<?php

require_once('../shared/initialize.php');

require_login();

if(is_post_request()) {
  $subject = [];
  $employee['first_name'] = $_POST['first_name'] ?? '';
  $employee['last_name'] = $_POST['last_name'] ?? '';
  $employee['email'] = $_POST['email'] ?? '';
  $employee['username'] = $_POST['username'] ?? '';
  $employee['password'] = $_POST['password'] ?? '';
  $employee['confirm_password'] = $_POST['confirm_password'] ?? '';

  $result = insert_employee($employee);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'Employee created.';
    redirect_to(url_for('/employees/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $employee = [];
  $employee["first_name"] = '';
  $employee["last_name"] = '';
  $employee["email"] = '';
  $employee["username"] = '';
  $employee['password'] = '';
  $employee['confirm_password'] = '';
}

?>

<?php $page_title = 'Create Employee'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/index.php'); ?>">&laquo; Back to List</a>

  <div class="employee new">
    <h1>Create Employee</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employees/new.php'); ?>" method="post">
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
        <dt>Email </dt>
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
        <input type="submit" value="Create Employee" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
