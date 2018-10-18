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
  include_once('./config/cmd_access.php');
  if (isset($_GET['cmd'])){
    if (isset($CMD_LIST[$_GET['cmd']])){
      include_once('./cmd/'.$CMD_LIST[$_GET['cmd']].'/index.php');
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset = "utf-8">
    <title>Sketchhub</title>
    <link rel = "stylesheet" type = "text/css" href = "assets/css/main.min.css">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
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
  </body>
</html>
