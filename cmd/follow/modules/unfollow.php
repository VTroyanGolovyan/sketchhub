<?php
if (isset($_GET['id'])){
  $id = (int)$_GET['id'];
  $query = 'DELETE FROM `followers` WHERE `follower`="'.$_SESSION[$host]['id'].'" AND `object` = "'.$id.'"';
  $res = $mysqli->query($query);
}
?>
