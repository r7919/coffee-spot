<?php
 session_start();
 include('config.php');

 $errors = array();

 if(isset($_POST['reg_user'])) {
 	$myusername = mysqli_real_escape_string($db,$_POST['username']);
 	$mypassword = mysqli_real_escape_string($db,$_POST['pass']);
 	$myreenter = mysqli_real_escape_string($db,$_POST['pass1']);
 

  if ($mypassword != $myreenter) {
  	array_push($errors,"-Passwords doesn't match");
  }

  $user_check = "select * from user where user_name = '$myusername' LIMIT 1";
  $result = mysqli_query($db,$user_check);
  $use = mysqli_fetch_assoc($result);

  if($use) {
  if($use['user_name'] === $myusername) {
       array_push($errors,"username already exists");
  }
}

  if(count($errors) == 0) {
  	$query = "insert into user (user_name,user_password) values ('$myusername','$mypassword')" ;
  	mysqli_query($db,$query);
    $_SESSION['username'] =$myusername;
    $_SESSION['success'] = "you are now logged in";
    header('location: homepage.php');
  }
}

if(isset($_POST['login_user'])) {
	$myusername = mysqli_real_escape_string($db, $_POST['username']);
	$mypassword = mysqli_real_escape_string($db, $_POST['pass']);

	if(count($errors) == 0) {
		$query = "select * from user where user_name = '$myusername' and user_password ='$mypassword'";
		$results = mysqli_query($db,$query);

		if (mysqli_num_rows($results) == 1) {
			$_SESSION['username'] = $myusername;
			$_SESSION['success'] = "you are now logged in";
			header('location: homepage.php');
		}
		else {
			array_push($errors,"wrong username/password combination");
		}
	}
}
?> 