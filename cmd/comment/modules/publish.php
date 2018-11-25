<?php

  if ($_GET['id'] && isset($_POST['text']) && !empty($_POST['text'])){
    $text = nl2br(htmlspecialchars(trim($_POST['text'])));
    $id=(int)$_GET['id'];
    if ( !empty($text)){
      $query = 'UPDATE `photos` SET `comments`=`comments`+1 WHERE `id`="'.$id.'"';
      $mysqli->query($query);
      $date = date('Y-m-d H:i:s');
      $query = 'INSERT INTO `comments` (`id`,`owner`,`subject`,`date`,`text`) ';
      $query.= 'VALUES (NULL,"'.$_SESSION[$host]['id'].'","'.$id.'","'.$date.'","'.$text.'")';
      $mysqli->query($query);
    }

  }
 ?>
