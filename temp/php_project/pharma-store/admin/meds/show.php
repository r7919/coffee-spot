<?php require_once('../shared/initialize.php'); ?>

<?php

require_login();

$id = $_GET['id'] ?? '1'; 

$medicine = find_medicine_by_id($id);

?>

<?php $page_title = 'Show Medicine'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/meds/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject show">

    <h1><?php echo h($medicine['medicine_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Price</dt>
        <dd><?php echo h($medicine['medicine_price']); ?></dd>
      </dl>
      <dl>
        <dt>Quantitiy</dt>
        <dd><?php echo h($medicine['medicine_qty']); ?></dd>
      </dl>
      <dl>
        <dt>Status</dt>
        <dd><?php echo h($medicine['stock_alert']); ?></dd>
      </dl>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>