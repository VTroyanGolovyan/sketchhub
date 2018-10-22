<?php
  include_once('init/init.php');
  if (isset($_SESSION[$host]['id'])){
    print $_SESSION[$host]['id'];
  }
?>
