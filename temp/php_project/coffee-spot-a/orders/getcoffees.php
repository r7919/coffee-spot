<?php 

require_once('../shared/initialize.php');

$errors = [];

$coffee_set = find_all_coffees(); 
$coffee_array = [];

while($coffee = mysqli_fetch_assoc($coffee_set)) {
    $coffee_array[] = $coffee;
}

echo json_encode($coffee_array);

mysqli_free_result($coffee_set); 

db_disconnect($db);

?>
  