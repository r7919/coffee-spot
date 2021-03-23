<?php

require_once('../shared/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/coffees/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_coffee($id);
  $_SESSION['message'] = 'The coffee was deleted successfully.';
  redirect_to(url_for('/coffees/index.php'));

} else {
  $coffee = find_coffee_by_id($id);
}

?>

<?php $page_title = 'Delete Coffee'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/coffees/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject delete">
    <h1>Delete Coffee</h1>
    <p>Are you sure you want to delete this coffee?</p>
    <p class="item"><?php echo h($coffee['coffee_name']); ?></p>

    <form action="<?php echo url_for('/coffees/delete.php?id=' . h(u($coffee['coffee_id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Coffee" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
