<?php
function reg_event($mysqli,$type,$cause,$object,$receiver){
  $query = 'INSERT INTO `events` (`id`, `cause`, `object`, `type`, `receiver`) VALUES (NULL, "'.$cause.'","'.$object.'","'.$type.'","'.$receiver.'")';
  $mysqli->query($query);
}
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
function make_verify_mail($name,$code){
  $body = '<html>'
            .'<head>'
              .'<meta charset="utf-8">'
              .'<style>'
                  .'h1{ width:100%; text-align:center; }'
                  .'b{ color:red; }'
              .'</style>'
            .'</head>'
            .'<body>'
              .'<div>'
                .'<h1>Подтверждение аккаунта</h1>'
              .'</div>'
              .'<div>'
                .'<p>Здравтвуйте, '.$name.'! Добро пожаловать в систему SketchHub!</p>'
                .'<p>У нас тепло, уютно и много фишечек:)</p>'
                .'<p><b>Никому не пересылайте это письмо!</b></p>'
                .'<p>Активируйте пожалуйста ваш аккаунт, это не займет много времени, нужно всего-лишь нажать на синюю ссылку!</p>'
                .'<a href="https://vhmanga.com/sketchhub/?cmd=sign&act=ver&verification_key='.$code.'&view=profile">Активировать мой аккаунт!</a>'
              .'</div>'
              .'<div>'
                .'<p>Если вы не регистрировались в нашей системе, просто проигнорируйте это сообщение.</p>'
              .'</div>'
            .'</body>'
        .'</html>';
   return $body;
}
function correct_text($type,$count){
  if ($type == 0){
    $last_num = ((int)$count)%10;

    switch ($last_num) {
      case 0:
          return 'Коментариев';
        break;
      case 1:
          return 'Коментарий';
        break;
      case 2:
          return 'Коментария';
        break;
      case 3:
          return 'Коментария';
        break;
      case 4:
          return 'Коментария';
        break;
      case 5:
          return 'Коментариев';
        break;
      case 6:
          return 'Коментариев';
        break;
      case 7:
          return 'Коментариев';
        break;
      case 8:
          return 'Коментариев';
        break;
      case 9:
          return 'Коментариев';
        break;
      default:
          return 'Коментариев';
        break;
    }
  }
  if ($type == 1){
    $last_num = ((int)$count)%10;

    switch ($last_num) {
      case 0:
          return 'Лайков';
        break;
      case 1:
          return 'Лайк';
        break;
      case 2:
          return 'Лайка';
        break;
      case 3:
          return 'Лайка';
        break;
      case 4:
          return 'Лайка';
        break;
      case 5:
          return 'Лайков';
        break;
      case 6:
          return 'Лайков';
        break;
      case 7:
          return 'Лайков';
        break;
      case 8:
          return 'Лайков';
        break;
      case 9:
          return 'Лайков';
        break;
      default:
          return 'Лайков';
        break;
    }
  }
}
 ?>
