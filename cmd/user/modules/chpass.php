<?php
  if (isset($_POST['old']) && isset($_POST['new']) && isset($_POST['new_ch'])){
    $query = 'SELECT * FROM `users` WHERE `id`="'.$_SESSION[$host]['id'].'" LIMIT 1';
    $res = $mysqli->query($query);
    if ($res->num_rows){
      $row = $res->fetch_assoc();
      if ($row['password'] == md5(md5(htmlspecialchars(trim($_POST['old']))))
          && trim($_POST['new']) == trim($_POST['new_ch']){
            $query = 'UPDATE `users` SET `password`="'.md5(md5(htmlspecialchars(trim($_POST['old'])))).'" WHERE `id`="'.$_SESSION[$host]['id'].'"';
            $mysqli->query($query);
          }
    }
  }
 ?>
