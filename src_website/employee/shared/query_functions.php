<?php

  // orders

  function update_order_status($id) {
    global $db;

    $sql = "UPDATE orders SET ";
    $sql .= "order_status='Delivered' ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function find_all_orders_preparing() {
    global $db;

    $sql = "SELECT * FROM orders ";
    $sql .= "WHERE order_status='Preparing' ";
    $sql .= "ORDER BY ordered_at ASC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
  }

  function find_all_orders_delivered() {
    global $db;

    $sql = "SELECT * FROM orders ";
    $sql .= "WHERE order_status='Delivered' ";
    $sql .= "ORDER BY ordered_at DESC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
  }

  function validate_orders($coffee_array, $c_count, $order_qty) {
    $errors = [];

    // empty
    $sum = 0;
    for ($i = 1; $i <= $c_count; $i++) {
      $sum += (int) $order_qty[$i];
    }

    if($sum == 0) {
      $errors[] = "Pick atleast one coffee.";
    } 

    return $errors;
  }

  function insert_orders($coffee_array, $c_count, $order_qty) {
    global $db;

    $errors = validate_orders($coffee_array, $c_count, $order_qty);

    if(!empty($errors)) {
      return $errors;
    }

    $curr_time = date("Y-m-d") . " " . date("H:i");

    for ($i = 1; $i <= $c_count; $i++) {

      if ($order_qty[$i] == 0)
        continue;

      $sql = "INSERT INTO orders ";
      $sql .= "(user_id, coffee_id, coffee_name, quantity, order_status, ordered_at, expw_time) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $_SESSION['user_id']) . "', ";
      $sql .= "'" . db_escape($db, $coffee_array[$i]['coffee_id']) . "', ";
      $sql .= "'" . db_escape($db, $coffee_array[$i]['coffee_name']) . "', ";
      $sql .= "'" . db_escape($db, $order_qty[$i]) . "', ";
      $sql .= "'" . db_escape($db, 'Preparing') . "', ";
      $sql .= "'" . db_escape($db, $curr_time) . "', ";
      $sql .= "'" . 0 . "'";
      $sql .= ")";

      $result = mysqli_query($db, $sql);

      // For INSERT statements, $result is true/false
      if(!($result)) {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }

    return true;
  }

  function find_all_user_orders() {
    global $db;

    $sql = "SELECT * FROM orders ";
    $sql .= "WHERE user_id=" . $_SESSION['user_id'] ." ";
    $sql .= "ORDER BY ordered_at DESC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
  }

  

  // Spot

  function find_all_reservations() {
    global $db;

    $sql = "SELECT * FROM reservation ";
    $sql .= "ORDER BY start_time ASC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
  }

  function get_spot_status($id) {
    global $db;

    $sql = "SELECT * FROM spot ";
    $sql .= "WHERE spot_id='" . $id . "' ";
    
    $result = mysqli_query($db, $sql);
    
    // For UPDATE statements, $result is true/false
    if($result) {
      while ($spot = mysqli_fetch_assoc($result)) {
        mysqli_free_result($result);
        return (int) $spot['spot_status'];
      }
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }   
  }

  // user reservations
  function find_all_user_reservations() {
    global $db;

    $sql = "SELECT * FROM reservation ";
    $sql .= "WHERE user_id=" . $_SESSION['user_id'] ." ";
    $sql .= "ORDER BY end_time DESC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
  }

  function find_all_active_reservations() {
    global $db;

    $sql = "SELECT * FROM reservation ";
    $sql .= "WHERE r_status='active'";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
  }

  function mark_as_deallocated($id) {
    global $db;

    $sql = "UPDATE reservation SET ";
    $sql .= "r_status='deallocated'";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  // dealloc
  function sync_spots() {
    $reservations = find_all_active_reservations();

    while ($reservation = mysqli_fetch_assoc($reservations)) {
      if (((int) strtotime($reservation['end_time'])) < ((int) (time()))) {
        update_spot($reservation['spot_id'], 0);
        mark_as_deallocated($reservation['id']);
      }
    }

    mysqli_free_result($reservations);
  }

  // alloc
  function update_spot($id, $status) {
    global $db;

    $sql = "UPDATE spot SET ";
    $sql .= "spot_status=" . $status . " ";
    $sql .= "WHERE spot_id=" . $id . " ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }    
  }

  function find_all_spots($options=[]) {
    global $db;

    $sql = "SELECT * FROM spot ";
    $sql .= "ORDER BY spot_id ASC";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function empty_spots_count() {
    global $db;

    $sql = "SELECT COUNT(*) AS C FROM spot ";
    $sql .= "WHERE spot_status=0";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return (int) mysqli_fetch_assoc($result)['C'];
  }

  function validate_reservation($spot_ids, $start_time, $end_time) {
    $errors = [];

    // start time
    if (is_blank($start_time)) {
      $errors[] = "Start time cannot be blank.";
    }

    // end time
    if (is_blank($end_time)) {
      $errors[] = "End time cannot be blank.";
    }

    // spots full
    if (empty_spots_count() == 0) {
      $errors[] = "Sorry, all spots are booked.";
    }
    else if (count($spot_ids) == 0) {
      $errors[] = "Select atleast one spot.";
    }
    else if (count($spot_ids) > 4) {
      $errors[] = "Sorry you can book at max 4 at a time.";
    }

    // validate time
    $start_time = date("Y-m-d") . " " . $start_time;
    $end_time = date("Y-m-d") . " " . $end_time;
    $open_time = date("Y-m-d") . " " . "00:30";
    $close_time = date("Y-m-d") . " " . "23:30";

    if (((int) strtotime($start_time)) >= ((int) strtotime($end_time))) {
      $errors[] = "Please enter a valid time range";
    }
    else if (((int) strtotime($start_time)) <= ((int) strtotime($open_time))) {
      $errors[] = "Our working hours are from 12:30 AM to 11:30 PM";
    }
    else if (((int) strtotime($end_time)) >= ((int) strtotime($close_time))) {
      $errors[] = "Our working hours are from 12:30 AM to 11:30 PM";
    }
    else if (((int) strtotime($start_time)) <= ((int) (time()))) {
      $errors[] = "Start time cannot be less than current time.";
    }

    return $errors;
  }

  function insert_to_reservation($spot_ids, $start_time, $end_time) {
    global $db;

    $errors = validate_reservation($spot_ids, $start_time, $end_time);

    if(!empty($errors)) {
      return $errors;
    }

    $start_time = date("Y-m-d") . " " . $start_time;
    $end_time = date("Y-m-d") . " " . $end_time;

    foreach ($spot_ids as $spot_id) {
      $sql = "INSERT INTO reservation ";
      $sql .= "(user_id, spot_id, start_time, end_time, r_status) ";
      $sql .= "VALUES (";
      $sql .= "" . $_SESSION['user_id'] . ", ";
      $sql .= "" . $spot_id . ", ";
      $sql .= "'" . $start_time . "', ";
      $sql .= "'" . $end_time . "', ";
      $sql .= "'active'";
      $sql .= ")";

      $result = mysqli_query($db, $sql);
      echo $sql;

      if(!($result)) {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }    

      update_spot($spot_id, 1);
    }
    
    return true;
  }

  // Coffees

  function find_all_coffees($options=[]) {
    global $db;

    $sql = "SELECT * FROM coffee ";
    $sql .= "ORDER BY coffee_id ASC";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_all_trending($options=[]) {
    global $db;

    $sql = "SELECT * FROM coffee ";
    $sql .= "ORDER BY trend_val DESC ";
    $sql .= "LIMIT 5";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }


  function find_coffee_by_id($id, $options=[]) {
    global $db;

    $sql = "SELECT * FROM coffee ";
    $sql .= "WHERE coffee_id='" . db_escape($db, $id) . "' ";

    // echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $coffee = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $coffee; // returns an assoc. array
  }

  function validate_coffee($coffee) {
    $errors = [];

    // string
    if(is_blank($coffee['coffee_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($coffee['coffee_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    //int
    $p_int = (int) $coffee['coffee_price'];
    if($p_int <= 0) {
      $errors[] = "Price must be greater than zero.";
    }
    if($p_int > 9999) {
      $errors[] = "Price must be less than 9999.";
    }

    $p_int = (int) $coffee['cook_time'];
    if($p_int <= 0) {
      $errors[] = "Time must be greater than zero.";
    }
    if($p_int > 9999) {
      $errors[] = "Time must be less than 9999.";
    }

    $p_int = (int) $coffee['trend_val'];
    if($p_int <= 0) {
      $errors[] = "Trend Value must be greater than zero.";
    }
    if($p_int > 9999) {
      $errors[] = "Trend Value must be less than 9999.";
    }

    return $errors;
  }

  function insert_coffee($coffee) {
    global $db;

    $errors = validate_coffee($coffee);

    if(!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO coffee ";
    $sql .= "(coffee_name, coffee_price, cook_time, trend_val) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $coffee['coffee_name']) . "', ";
    $sql .= "'" . db_escape($db, $coffee['coffee_price']) . "', ";
    $sql .= "'" . db_escape($db, $coffee['cook_time']) . "', ";
    $sql .= "'" . db_escape($db, $coffee['trend_val']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_coffee($coffee) {
    global $db;

    $errors = validate_coffee($coffee);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE coffee SET ";
    $sql .= "coffee_name='" . db_escape($db, $coffee['coffee_name']) . "', ";
    $sql .= "coffee_price='" . db_escape($db, $coffee['coffee_price']) . "', ";
    $sql .= "cook_time='" . db_escape($db, $coffee['cook_time']) . "', ";
    $sql .= "trend_val='" . db_escape($db, $coffee['trend_val']) . "' ";
    $sql .= "WHERE coffee_id='" . db_escape($db, $coffee['coffee_id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function delete_coffee($id) {
    global $db;

    $sql = "DELETE FROM coffee ";
    $sql .= "WHERE coffee_id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  // Users

  // Find all users, ordered id
  function find_all_users() {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_user_by_id($id) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function find_user_by_username($username) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function find_employee_by_username($username) {
    global $db;

    $sql = "SELECT * FROM employees ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $employee = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $employee; // returns an assoc. array
  }

  function validate_user($user, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($user['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($user['username'], $user['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if($password_required) {
      if(is_blank($user['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($user['password'], array('min' => 12))) {
        $errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($user['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($user['password'] !== $user['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
      }
    }
    
    return $errors;
  }

  function insert_user($user) {
    global $db;

    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users ";
    $sql .= "(username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $user['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

?>
