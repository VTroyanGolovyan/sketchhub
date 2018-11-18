<?php
  if (isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $query = 'SELECT * FROM `followers` WHERE `follower`="'.$_SESSION[$host]['id'].'" AND `object` = "'.$id.'"';
    $res = $mysqli->query($query);
    if ($res->num_rows == 0){
      $query = 'INSERT IGNORE INTO `followers` (`id`,`follower`,`object`) VALUES (NULL,"'.$_SESSION[$host]['id'].'","'.$id.'")';
      $mysqli->query($query);
      $query = 'UPDATE `users` SET `following`=`following`+1 WHERE `id`="'.$_SESSION[$host]['id'].'"; ';
      $query .= 'UPDATE `users` SET `followers`=`followers`+1 WHERE `id`="'.$id.'"; ';
      $mysqli->multi_query($query);
    }
  }
 ?>
