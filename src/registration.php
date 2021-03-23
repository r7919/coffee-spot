<?php include('server.php') ?>
<html>
<body>
<style>
	h1  {color: blue; text-align: center;}
	body {font-family: Arial, Helvetica, sans-serif;background-color:#FFB03B;}
	input[type=text], input[type=password] {
  width: 20%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 2px solid red;
  border-radius: 4px;
  box-sizing: border-box;
  text-align: center;
}
	button {
  background-color:#5B1B02;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 10%;
}
.imgcontainer {
  text-align: center;
  margin: 12px 0 6px 0;
  width : 70%;
  margin-left: auto;
  margin-right: auto;
  left: 0;
}
.container {
	text-align: center;
	margin: 12px 0 6px 0;
	margin-left: auto;
  margin-right: auto;
  right: 0;
  /*background-color: blue;*/
}

img.avatar {
  width: 40%;
  border-radius: 50%;
  margin-left: auto;
  margin-right: auto;
}
</style>
<h1> Registration Form </h1>
<form action="registration.php" method="post">
	<?php include('errors.php') ?>
		<div class="imgcontainer">
			<img src="coffee.png" alt="Avatar" class="avatar">
		</div>
		<div class="container">
			<label for="username" ><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="username" required><br>
			<label for="pass"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="pass" required><br>
			<label for="pass1"><b>re-enter password</b></label>
			<input type="password" placeholder="re-Enter Password" name="pass1" required><br>
			<button type="submit" name="reg_user">Register</button><br>Already a user? <a href="login.php" >Login</a>
		</div>
</form>
</body>
</html>