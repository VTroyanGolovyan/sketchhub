<?php
  if (isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $query = 'SELECT * FROM `followers` WHERE `follower`="'.$_SESSION[$host]['id'].'" AND `object` = "'.$id.'"';
    $res = $mysqli->query($query);
    if ($res->num_rows == 0){
      $query = 'INSERT INTO `followers` (`id`,`follower`,`object`) VALUES (NULL,"'.$_SESSION[$host]['id'].'","'.$id.'")';
      $mysqli->query($query);
    }
  }
 ?>
