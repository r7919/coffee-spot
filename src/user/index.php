<?php require_once('shared/initialize.php'); ?>

<?php require_login(); ?>

<?php $page_title = 'User Menu'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/spots/index.php'); ?>">Spots</a></li>
      <li><a href="<?php echo url_for('/orders/index.php'); ?>">Orders</a></li>
    </ul>
  </div>
</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
