<?php

  // Spot Prices
  function find_price_by_type($type) {
    global $db;

    $sql = "SELECT * FROM spot_price ";
    $sql .= "WHERE spot_type='" . db_escape($db, $type) . "' ";

    // echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $price = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $price; // returns an assoc. array
  }

  function find_all_prices($options=[]) {
    global $db;

    $sql = "SELECT * FROM spot_price";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }


  function validate_price($price) {
    $errors = [];

    //int
    $base_price = (int) $price['base_price'];
    if($base_price <= 0) {
      $errors[] = "Base price must be greater than zero.";
    }
    if($base_price > 9999) {
      $errors[] = "Base price must be less than 9999.";
    }

    $incr_price = (int) $price['incr_price'];
    if($incr_price <= 0) {
      $errors[] = "Increment price must be greater than zero.";
    }
    if($incr_price > 9999) {
      $errors[] = "Increment price must be less than 9999.";
    }
    
    return $errors;
  }

  function update_price($price) {
    global $db;

    $errors = validate_price($price);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE spot_price SET ";
    $sql .= "base_price='" . db_escape($db, $price['base_price']) . "', ";
    $sql .= "incr_price='" . db_escape($db, $price['incr_price']) . "' ";
    $sql .= "WHERE spot_type='" . db_escape($db, $price['spot_type']) . "' ";
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



  // Medicines

  function find_all_medicines($options=[]) {
    global $db;

    $sql = "SELECT * FROM medicine ";
    $sql .= "ORDER BY medicine_id ASC";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }


  function find_medicine_by_id($id, $options=[]) {
    global $db;

    $sql = "SELECT * FROM medicine ";
    $sql .= "WHERE medicine_id='" . db_escape($db, $id) . "' ";

    // echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $medicine = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $medicine; // returns an assoc. array
  }

  function validate_medicine($medicine) {
    $errors = [];

    // string
    if(is_blank($medicine['medicine_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($medicine['medicine_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    //int
    $p_int = (int) $medicine['medicine_price'];
    if($p_int <= 0) {
      $errors[] = "Price must be greater than zero.";
    }
    if($p_int > 9999) {
      $errors[] = "Price must be less than 9999.";
    }

    return $errors;
  }


  function validate_add_medicine($medicine) {
    $errors = [];

    //int
    $p_int = (int) $medicine['medicine_qty'];
    if($p_int <= 0) {
      $errors[] = "Increment Qty must be greater than zero.";
    }
    if($p_int > 9999) {
      $errors[] = "Increment Qty must be less than 9999.";
    }

    return $errors;
  }


  function insert_medicine($medicine) {
    global $db;

    $errors = validate_medicine($medicine);

    if(!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO medicine ";
    $sql .= "(medicine_name, medicine_price, medicine_qty, stock_alert) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $medicine['medicine_name']) . "', ";
    $sql .= "'" . db_escape($db, $medicine['medicine_price']) . "', ";
    $sql .= "'" . db_escape($db, $medicine['medicine_qty']) . "', ";
    $sql .= "'" . db_escape($db, $medicine['stock_alert']) . "'";
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

  function update_medicine($medicine) {
    global $db;

    $errors = validate_medicine($medicine);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE medicine SET ";
    $sql .= "medicine_name='" . db_escape($db, $medicine['medicine_name']) . "', ";
    $sql .= "medicine_price='" . db_escape($db, $medicine['medicine_price']) . "' ";
    $sql .= "WHERE medicine_id='" . db_escape($db, $medicine['medicine_id']) . "' ";
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

  function add_supply_medicine($medicine) {
    global $db;

    $errors = validate_add_medicine($medicine);
    if(!empty($errors)) {
      return $errors;
    }

    $ival = (int) $medicine['medicine_qty'];

    $sql = "UPDATE medicine SET ";
    $sql .= "stock_alert='" . db_escape($db, $medicine['stock_alert']) . "', ";
    $sql .= "medicine_qty = medicine_qty + {$ival} ";
    $sql .= "WHERE medicine_id='" . db_escape($db, $medicine['medicine_id']) . "' ";
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

  function delete_medicine($id) {
    global $db;

    $sql = "DELETE FROM medicine ";
    $sql .= "WHERE medicine_id='" . db_escape($db, $id) . "' ";
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

  // Admins

  // Find all admins, ordered last_name, first_name
  function find_all_admins() {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function validate_admin($admin, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($admin['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($admin['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($admin['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($admin['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if($password_required) {
      if(is_blank($admin['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($admin['password'], array('min' => 12))) {
        $errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($admin['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($admin['password'] !== $admin['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
      }
    }
    
    return $errors;
  }

  function insert_admin($admin) {
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['email']) . "',";
    $sql .= "'" . db_escape($db, $admin['username']) . "',";
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

  function update_admin($admin) {
    global $db;

    $password_sent = !is_blank($admin['password']);

    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE admins SET ";
    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
    if($password_sent) {
      $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='" . db_escape($db, $admin['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
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

  function delete_admin($admin) {
    global $db;

    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1;";
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

    // Employees 

  // Find all employees, ordered last_name, first_name
  function find_all_employees() {
    global $db;

    $sql = "SELECT * FROM employees ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_employee_by_id($id) {
    global $db;

    $sql = "SELECT * FROM employees ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $employee = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $employee; // returns an assoc. array
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

  function validate_employee($employee, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($employee['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($employee['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($employee['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($employee['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($employee['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($employee['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($employee['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($employee['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($employee['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($employee['username'], $employee['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if($password_required) {
      if(is_blank($employee['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($employee['password'], array('min' => 12))) {
        $errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $employee['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $employee['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $employee['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $employee['password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($employee['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($employee['password'] !== $employee['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
      }
    }
    
    return $errors;
  }

  function insert_employee($employee) {
    global $db;

    $errors = validate_employee($employee);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($employee['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO employees ";
    $sql .= "(first_name, last_name, email, username, hashed_password, current_orders) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $employee['first_name']) . "',";
    $sql .= "'" . db_escape($db, $employee['last_name']) . "',";
    $sql .= "'" . db_escape($db, $employee['email']) . "',";
    $sql .= "'" . db_escape($db, $employee['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "',";
    $sql .= "'" . db_escape($db, $employee['current_orders']) . "'";
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

  function update_employee($employee) {
    global $db;

    $password_sent = !is_blank($employee['password']);

    $errors = validate_employee($employee, ['password_required' => $password_sent]);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($employee['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE employees SET ";
    $sql .= "first_name='" . db_escape($db, $employee['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $employee['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $employee['email']) . "', ";
    if($password_sent) {
      $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='" . db_escape($db, $employee['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $employee['id']) . "' ";
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

  function delete_employee($employee) {
    global $db;

    $sql = "DELETE FROM employees ";
    $sql .= "WHERE id='" . db_escape($db, $employee['id']) . "' ";
    $sql .= "LIMIT 1;";
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

?>
