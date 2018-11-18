<?php
  $query = 'SELECT * FROM `users` WHERE `id`="'.$_SESSION[$host]['id'].'"';
  $res = $mysqli->query($query);
  $row = $res->fetch_assoc();
  if ($row['avatar'] != ''){
    unlink($row['avatar']);
  }
  $query = 'UPDATE `users` SET `avatar`="" WHERE `id`="'.$_SESSION[$host]['id'].'"';
  $mysqli->query($query);
?>
