<?php
  include_once('init/init.php');
  $f = false;
  if (isset($_SESSION[$host]['id'])){
    if (isset($_GET['id'])){
      $id = (int)$_GET['id'];
      $query = 'SELECT * FROM `likes` WHERE `owner`="'.$_SESSION[$host]['id'].'" AND `subject` = "'.$id.'"';
      $res = $mysqli->query($query);
      if ($res->num_rows == 0){
        $query = 'UPDATE `photos` SET `likes`=`likes`+1 WHERE `id`="'.$id.'"';
        $mysqli->query($query);
        $date = date('Y-m-d H:i:s');
        $query = 'INSERT INTO `likes` (`id`,`owner`,`subject`,`date`) ';
        $query.= 'VALUES (NULL,"'.$_SESSION[$host]['id'].'","'.$id.'","'.$date.'")';
        $mysqli->query($query);
        $f = true;
      }else{
        $query = 'UPDATE `photos` SET `likes`=`likes`-1 WHERE `id`="'.$id.'"';
        $mysqli->query($query);

        $query = 'DELETE FROM `likes` WHERE `owner`="'.$_SESSION[$host]['id'].'" AND `subject` = "'.$id.'"';
        $mysqli->query($query);
      }
    }

    $query = 'SELECT `id`,`likes`,`owner` FROM `photos` WHERE `id`="'.$id.'"';
    $res = $mysqli->query($query);
    if ($res->num_rows != 0){
      $row = $res->fetch_assoc();
      print $row['likes'];
      if ($f)
        reg_event($mysqli,1,$_SESSION[$host]['id'],$id,$row['owner']);
    }
  }

 ?>
