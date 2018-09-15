<?php
if (! empty($_FILES['avatar']['name'])){
  if($_FILES['avatar']['error'] == 0){
    if(substr($_FILES['avatar']['type'],0,5)=='image'){
      $image = new image_worker($_FILES['avatar']['tmp_name']);
      $image->load();
      $image->crop(800,800);
      $filenew = 'content/userdata/'.$_SESSION[$host]['id'].'/avatar_'.generate_hash(15);
      $filenew = $image->save($filenew);
      $query = 'SELECT * FROM `users` WHERE `id`="'.$_SESSION[$host]['id'].'"';
      $res = $mysqli->query($query);
      $row = $res->fetch_assoc();
      if ($row['avatar'] != ''){
        unlink($row['avatar']);
      }
      $query = 'UPDATE `users` SET `avatar`="'.$filenew.'" WHERE `id`="'.$_SESSION[$host]['id'].'"';
      $mysqli->query($query);
    }
  }
}

 ?>
