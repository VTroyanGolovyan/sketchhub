<?php
  if (isset($_GET['act'])){
    switch ($_GET['act']) {
      case 'photo':
          include('modules/photo.php'); //вход
        break;
      case 'avatar':
          include('modules/avatar.php'); //вход
        break;
    }
  }
?>
