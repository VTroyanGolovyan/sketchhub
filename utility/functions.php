<?php
function generate_hash($length){
     //символы из которых генерируем
     $string='qwertyuiopadfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM';
     //генерация
     $hash='';
     for ($i = 0;$i<$length;$i++){
       $hash.=$string[mt_rand(0,strlen($string)-1)];
     }
     return $hash;
}
//кривой редирект
function refresh($url)
{
    print '<script>';
    print 'location.href="'.$url.'";';
    print '</script>';
    exit;
}
function is_follower($mysqli,$id1,$id2){
  $query = 'SELECT `id` FROM `followers` WHERE `follower`="'.$id1.'" and `object`="'.$id2.'"';
  $res = $mysqli->query($query);
  if ($res->num_rows == 0)
    return false;
  else return true;
}
 ?>
