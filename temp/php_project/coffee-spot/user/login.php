<?php

require_once('shared/initialize.php');

if (is_logged_in())
  redirect_to(url_for('/index.php'));

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    // Using one variable ensures that msg is the same
    $login_failure_msg = "Log in was unsuccessful.";

    $user = find_user_by_username($username);

    if($user) {

      if(password_verify($password, $user['hashed_password'])) {
        // password matches
        log_in_user($user);
        redirect_to(url_for('/index.php'));
      } else {
        // username found, but password does not match
        $errors[] = $login_failure_msg;
      }

    } else {
      // no username found
      $errors[] = $login_failure_msg;
    }

  }

}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

<div id="content" class="center" style="padding: 10p; text-align:center; margin: auto;">
  <img src="/php_project/coffee-spot/images/logo2.png" width=150 height=150></img>
  <h1>Log in</h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    Username:<br />
    <input type="text" name="username" value="<?php echo h($username); ?>" /><br /> <br />
    Password:<br />
    <input type="password" name="password" value="" /><br /> <br />
    <input type="submit" name="submit" value="Submit"  />
  </form>

  <br /><a href="<?php echo url_for('/register.php'); ?>">Create New Account  </a>
  <br /><br /><a href="<?php echo url_for('/../employee/index.php'); ?>">Employee Portal</a>
</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
