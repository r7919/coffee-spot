<?php
require_once('shared/initialize.php');

log_out_user();
redirect_to(url_for('/login.php'));
?>
