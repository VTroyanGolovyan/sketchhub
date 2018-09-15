<?php
if (! empty($_FILES['photo']['name'])){
  if($_FILES['photo']['error'] == 0){
    if(substr($_FILES['photo']['type'],0,5)=='image'){
      $image = new image_worker($_FILES['photo']['tmp_name']);
      $image->load();
      $image->crop(800,800);
      $filenew = 'content/userdata/'.$_SESSION[$host]['id'].'/photo/photo_'.generate_hash(15);
      $filenew = $image->save($filenew);
      $query = 'INSERT INTO `photos` (`id`,`owner`,`url`) VALUES (NULL, "'.$_SESSION[$host]['id'].'","'.$filenew.'")';
      $mysqli->query($query);
    }
  }
}

 ?>
