<?php
  if (isset($_GET['act'])){
    switch ($_GET['act']) {
      case 'in':
          include('modules/in.php'); //вход
        break;
      case 'up':
          include('modules/up.php');  //регистрация
        break;
      case 'out':
          include('modules/out.php'); //выход
        break;
      case 'ver':
          include('modules/ver.php'); //выход
        break;
      default:
          include('modules/in.php'); //вход по дефолту
        break;
    }
  }

 ?>
