<?php

require_once('../shared/initialize.php');

require_login();

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$employee = find_employee_by_id($id);

?>

<?php $page_title = 'Show Employee'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/index.php'); ?>">&laquo; Back to List</a>

  <div class="employee show">

    <h1>Employee: <?php echo h($employee['username']); ?></h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/employees/edit.php?id=' . h(u($employee['id']))); ?>">Edit</a>
      <a class="action" href="<?php echo url_for('/employees/delete.php?id=' . h(u($employee['id']))); ?>">Delete</a>
    </div>

    <div class="attributes">
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($employee['first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($employee['last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($employee['email']); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($employee['username']); ?></dd>
      </dl>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>