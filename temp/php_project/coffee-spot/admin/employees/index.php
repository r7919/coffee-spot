<?php

require_once('../shared/initialize.php');

require_login();

$employee_set = find_all_employees();

?>

<?php $page_title = 'Employees'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div class="employees listing">
    <h1>Employees</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/employees/new.php'); ?>">Create New Employee</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th>Username</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php while($employee = mysqli_fetch_assoc($employee_set)) { ?>
        <tr>
          <td><?php echo h($employee['id']); ?></td>
          <td><?php echo h($employee['first_name']); ?></td>
          <td><?php echo h($employee['last_name']); ?></td>
          <td><?php echo h($employee['email']); ?></td>
          <td><?php echo h($employee['username']); ?></td>
          <td><a class="action" href="<?php echo url_for('/employees/show.php?id=' . h(u($employee['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/employees/edit.php?id=' . h(u($employee['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/employees/delete.php?id=' . h(u($employee['id']))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

    <?php
      mysqli_free_result($employee_set);
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
