<?php
  if (isset($_GET['verification_key'])){
    $key = trim(htmlspecialchars($_GET['verification_key']));
    $query = 'SELECT * FROM `users` WHERE `verification_key`="'.$key.'"';
    $res = $mysqli->query($query);
    if ($res->num_rows != 0){
      $user = $res->fetch_assoc();
      if (!empty($user['verification_key']) && $user['verification_key'] == $key){
        $query = 'UPDATE `users` SET `verification_key`="", `access`="10" WHERE `id`="'.$user['id'].'"';
        $mysqli->query($query);
        $_SESSION[$host]['id'] = $user['id'];
        $_SESSION[$host]['access'] = 10;
      }
    }
  }

 ?>
