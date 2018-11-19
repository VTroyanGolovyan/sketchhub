<?php
  if (isset($_GET['act'])){
    switch ($_GET['act']) {
      case 'in':
            include('modules/follow.php'); //подписаться
        break;
      case 'un':
            include('modules/unfollow.php'); //отписаться
        break;
      default:
        // code...
        break;
    }
  }

 ?>
