<?php
  if (isset($_GET['act'])){
    switch ($_GET['act']) {
      case 'in':
            include('modules/follow.php'); //подписаться
        break;
      case 'out':
            include('modules/unfollow.php'); //отписаться
        break;
      default:
        // code...
        break;
    }
  }

 ?>
