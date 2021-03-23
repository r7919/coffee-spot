<?php

  // Coffees

  function find_all_coffees($options=[]) {
    global $db;

    $sql = "SELECT * FROM coffee ";
    $sql .= "ORDER BY coffee_id ASC";

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
