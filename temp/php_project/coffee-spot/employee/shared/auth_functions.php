<?php

  // Performs all actions necessary to log in an employee
  function log_in_employee($employee) {
  // Renerating the ID protects the employee from session fixation.
    session_regenerate_id();
    $_SESSION['user_id'] = $employee['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $employee['username'];
    return true;
  }

  // Performs all actions necessary to log out an employee
  function log_out_employee() {
    unset($_SESSION['user_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    // session_destroy(); // optional: destroys the whole session
    return true;
  }


  // is_logged_in() contains all the logic for determining if a
  // request should be considered a "logged in" request or not.
  // It is the core of require_login() but it can also be called
  // on its own in other contexts (e.g. display one link if an employee
  // is logged in and display another link if they are not)
  function is_logged_in() {
    // Having a user_id in the session serves a dual-purpose:
    // - Its presence indicates the employee is logged in.
    // - Its value tells which employee for looking up their record.
    // print_r($_SESSION);
    return isset($_SESSION['user_id']);
  }

  // Call require_login() at the top of any page which needs to
  // require a valid login before granting acccess to the page.
  function require_login() {
    if(!is_logged_in()) {
      redirect_to(url_for('/login.php'));
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }

?>
