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
 ?>
