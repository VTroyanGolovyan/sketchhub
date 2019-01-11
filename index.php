<?php
  require_once('./config/config.php'); //конфигурация сайта

  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);

  require_once('./utility/image_worker.php');
  require_once('./utility/functions.php');
  require_once('./utility/pagination.php');
  require_once('./db/db.php');
  session_start();
?>
<?php
  if (isset($_GET['evt'])){
    $evt = (int)$_GET['evt'];
    $query = 'DELETE FROM `events` WHERE `id`="'.$evt.'" AND `receiver`="'.$_SESSION[$host]['id'].'"';
    $mysqli->query($query);
  }
  include_once('./config/cmd_access.php');
  if (isset($_GET['cmd'])){
    if (isset($CMD_LIST[$_GET['cmd']])){
      include_once('./cmd/'.$CMD_LIST[$_GET['cmd']].'/index.php');
      $url_after_update = "./?";
      foreach ($_GET as $key => $value) {
        $_GET[ $key ] = htmlspecialchars(strip_tags($value));
        if (strcmp($key, "cmd") != 0) {
          $url_after_update .= $key . '=' . $_GET[ $key ] . '&';
        }
      }
      $url_after_update = substr($url_after_update, 0, strlen($url_after_update) - 1);
      header('Location: ' . $url_after_update);      
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset = "utf-8">
    <title>Sketchhub</title>
    <link rel = "stylesheet" type = "text/css" href = "assets/css/main.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="./sh.png">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  </head>
  <body>
    <?php
      include_once('./config/view_access.php');

      if (isset($_GET['view'])){

        if (isset($VIEW_LIST[$_GET['view']])){
          include_once('./views/'.$VIEW_LIST[$_GET['view']]);
        }elseif (isset($_SESSION[$host]['id']))
          include_once('./views/profile.php');
        else include_once('./views/signin.php');

      }else{
        if (isset($_SESSION[$host]['id']))
            include_once('./views/profile.php');
          else include_once('./views/signin.php');
      }
     ?>
     <script src="./assets/js/like.js"></script>
     <script src="./assets/js/events.js"></script>
  </body>
</html>
