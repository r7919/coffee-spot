<?php

require_once('../shared/initialize.php');

require_login();

if(is_post_request()) {

    $spots_upd = [];

    for ($i = 1; $i <= 31; $i++) {
        if ($_POST["{$i}"] == 1) {
            $spots_upd[] = $i;
        }
    }

    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $result = insert_to_reservation($spots_upd, $start_time, $end_time);

    if($result === true) {
        $_SESSION['message'] = 'Selected spots are booked successfully.'; // _session message
        redirect_to(url_for('/spots/index.php')); // if post redirect to index
    } else {
        $errors = $result;
    }
} 

sync_spots();

$spots_set_q = find_all_spots();
$curr = 1;
while($spot = mysqli_fetch_assoc($spots_set_q)) {
    $spots_set[$curr] = $spot;
    $curr++;
}

function get_colour($id) {
    global $spots_set;

    if ($spots_set[$id]['spot_status'] == 0) {
        echo "#99FF99;"; 
    } else { 
        echo "#bbb;"; 
    }
}

function put_status($id) {
    global $spots_set;

    if ($spots_set[$id]['spot_status'] == 0) {
        echo '<input type="hidden" name="' . $id  . '" value="0" />
        <input type="checkbox" name="' . $id  . '" value="1" style="width: 15px; height: 15px;"/>
        <label for="' . $id  . '"> ' . $id  . ' </label>';
    } else {
        echo '<div style="text-align: center;">' . $id  . '</div>';
    }
}

?>

<?php $page_title = 'Book Spot'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/spots/index.php'); ?>">&laquo; Back</a>

  <div class="spot new">
    <h1>Select Spot(s)</h1> <br />

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/spots/new.php'); ?>" method="post">

        <div class="row">
            <div class="column_space">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(8) ?>">
               <?php put_status(8); ?>
            </div>

            <div class="column">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(16) ?>">
               <?php put_status(16); ?>
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(17) ?>">
               <?php put_status(17); ?>
            </div>

            <div class="column">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(20) ?>">
               <?php put_status(20); ?>
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(21) ?>">
               <?php put_status(21); ?>
            </div>

            <div class="column">
            </div>
            
            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(12) ?>">
               <?php put_status(12); ?>
            </div>
        </div>

        <div class="row">
            <div class="column_space">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(9) ?>">
               <?php put_status(9); ?>
            </div>

            <div class="column">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(18) ?>">
               <?php put_status(18); ?>
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(19) ?>">
               <?php put_status(19); ?>
            </div>

            <div class="column">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(22) ?>">
               <?php put_status(22); ?>
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(23) ?>">
               <?php put_status(23); ?>
            </div>

            <div class="column">
            </div>
            
            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(13) ?>">
               <?php put_status(13); ?>
            </div>
        </div>

        <div class="row">
            <div class="column_space">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
        </div>

        <div class="row">
            <div class="column_space">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(10) ?>">
               <?php put_status(10); ?>
            </div>

            <div class="column">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(24) ?>">
               <?php put_status(24); ?>
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(25) ?>">
               <?php put_status(25); ?>
            </div>

            <div class="column">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(28) ?>">
               <?php put_status(28); ?>
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(29) ?>">
               <?php put_status(29); ?>
            </div>

            <div class="column">
            </div>
            
            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(14) ?>">
               <?php put_status(14); ?>
            </div>
        </div>

        <div class="row">
            <div class="column_space">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(11) ?>">
               <?php put_status(11); ?>
            </div>

            <div class="column">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(26) ?>">
               <?php put_status(26); ?>
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(27) ?>">
               <?php put_status(27); ?>
            </div>

            <div class="column">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(30) ?>">
               <?php put_status(30); ?>
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(31) ?>">
               <?php put_status(31); ?>
            </div>

            <div class="column">
            </div>
            
            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(15) ?>">
               <?php put_status(15); ?>
            </div>
        </div>

        <div class="row">
            <div class="column_space">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
            </div>
        </div>

        <div class="row">
            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(1) ?>">
               <?php put_status(1); ?>
            </div>

            <div class="column_space">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(2) ?>">
               <?php put_status(2); ?>
            </div>

            <div class="column_space">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(3) ?>">
               <?php put_status(3); ?>
            </div>

            <div class="column_space">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(4) ?>">
               <?php put_status(4); ?>
            </div>

            <div class="column_space">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(5) ?>">
               <?php put_status(5); ?>
            </div>

            <div class="column_space">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(6) ?>">
               <?php put_status(6); ?>
            </div>

            <div class="column_space">
            </div>

            <div class="column" style="border: 2px solid #5B1B02; background: <?php get_colour(7) ?>">
               <?php put_status(7); ?>
            </div>

            <div class="column">
            </div>
        </div>

        <br />

        <dl>
          <dt>Start Time</dt>
          <dd><input type="time" name="start_time" value="" /></dd>
        </dl>

        <dl>
          <dt>End Time</dt>
          <dd><input type="time" name="end_time" value="" /></dd>
        </dl>

        <div id="operations" style="text-align: center;">
          <input type="submit" value="Book Selected Spots"/>
        </div>

    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
