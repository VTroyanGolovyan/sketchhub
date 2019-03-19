<?php
  if (isset($_POST['status'])){
    $status = htmlspecialchars($_POST['status']);
    $query = 'UPDATE `users` SET `about`="'.$status.'" WHERE `id`="'.$_SESSION[$host]['id'].'"';
    $mysqli->query($query);
  }
 ?>
