<?php
  if (isset($_GET['user'])){
     $id1 = $_SESSION[$host]['id'];
     $id2 = (int)$_GET['user'];
     $query = 'SELECT * FROM `dialogs` WHERE type="0" AND ( (`id1`="'.$id1.'" AND `id2`="'.$id2.'") OR (`id1`="'.$id2.'" AND `id2`="'.$id1.'") ) LIMIT 1';
     $res = $mysqli->query($query);
     if ($res->num_rows == 0){
       $query = 'INSERT INTO `dialogs` (`id`,`id1`,`id2`,`type`) VALUES (NULL,"'.$id1.'","'.$id2.'","0")';
        $mysqli->query($query);
     }
  }
 ?>
