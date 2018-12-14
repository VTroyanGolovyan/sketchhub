<?php
  include_once('init/init.php');
  if (isset($_SESSION[$host]['id'])){
    $query = 'SELECT `events`.`id` AS `evt_id`,`events`.`type`,`events`.`object`,`users`.`id` AS `u_id`, `users`.`name`,`users`.`last_name`,`users`.`avatar` FROM `events` INNER JOIN `users` ON `users`.`id`=`events`.`cause` WHERE `receiver`="'.$_SESSION[$host]['id'].'"';
    $res = $mysqli->query($query);
    $answer = array();
    if ($res->num_rows != 0){
      while ($row = $res->fetch_assoc()) {
        array_push($answer,$row);
      }
    }
  }
  print json_encode($answer);
 ?>
