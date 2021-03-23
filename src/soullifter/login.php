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
}

img.avatar {
  width: 40%;
  border-radius: 50%;
  margin-left: auto;
  margin-right: auto;
}
.error {color: #FF0000;}
</style>
<h1> Login Form </h1>
<form action="login.php" method="post">
   <?php include('errors.php') ?>
	 <div class="imgcontainer">
    <img src="coffee.png" alt="Avatar" class="avatar">
  </div>
  <center>
	<div class="container">
    <label for="username" ><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required><br>

    <label for="pass"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required><br>
        
    <button type="submit" name="login_user">Login</button><br>
  </div>
New user? <a href="registration.php" >Register</a>
  </center>
</form>

</body>
</html>