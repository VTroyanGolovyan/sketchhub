<?php
  include_once('init/init.php');

  if (isset($_SESSION[$host]['id'])){
    $img = $_POST['image'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $fileData = base64_decode($img);
    //savingg


 $name ='./content/userdata/'.$_SESSION[$host]['id'].'/photo/photo_'.generate_hash(15).'.png';
  $filenew = '.'.$name;
 file_put_contents($filenew, $fileData);
 $query = 'INSERT INTO `photos` (`id`,`owner`,`posted`,`url`,`type`,`comments`,`likes`) VALUES (NULL, "'.$_SESSION[$host]['id'].'","'.date('Y-m-d H-i-s').'","'.$name.'","1","0","0")';
 $mysqli->query($query);
   print '../?view=post&id='.$mysqli->insert_id;
  }
?>
