<?php require_once('shared/initialize.php'); ?>

<?php require_login(); ?>

<?php $page_title = 'Admin Menu'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/coffees/index.php'); ?>">Coffees</a></li>
      <li><a href="<?php echo url_for('/admins/index.php'); ?>">Admins</a></li>
    </ul>
  </div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
