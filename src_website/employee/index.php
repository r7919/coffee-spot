<?php require_once('shared/initialize.php'); ?>

<?php require_login(); ?>

<?php $page_title = 'Employee Menu'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/orders/index.php'); ?>">Orders</a></li>
    </ul>
  </div>
</div>

<?php include(SHARED_PATH . '/employee_footer.php'); ?>
