<?php
  if(!isset($page_title)) { $page_title = 'User Area'; }
?>


<!doctype html>

<html lang="en">
  <head>
    <title>CS - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/user.css'); ?>" />
  </head>

  <body>
    <header>
      <h1>Coffee Spot ~ 
      <?php 
        if (is_logged_in()) {
          echo $_SESSION['username'] ?? ''; 
          echo "'s";
        }
        else {
          echo "User";
        }
      ?>
      Area </h1>

    <div style="text-align: center;">
        <ul id="horizontal-list">
          <li><a href="<?php echo url_for('/index.php');?>" style="color: white;">Menu</a></li>
          <?php
            for ($i = 0; $i < 107; $i++)
              echo "<li>&nbsp;</li>";
          ?>
          <li>Time: <span id="span"></span></li>
          <?php
            for ($i = 0; $i < 110; $i++)
              echo "<li>&nbsp;</li>";
          ?>
          <li><a href="<?php echo url_for('/logout.php'); ?> " style="color: white;">Logout</a></li>
        </ul>
     </div>
    
     </header>

    <script>
      var span = document.getElementById('span');

      function time() {
        var d = new Date();
        var s = d.getSeconds();
        var m = d.getMinutes();
        var h = d.getHours();
        span.textContent = 
          ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
      }

      setInterval(time, 1000);
    </script>

    <?php echo display_session_message(); ?>
