<?php
  if (isset($_GET['act'])){
    switch ($_GET['act']) {
      case 'edit':
          include('modules/edit.php'); //вход
        break;
    }
  }
?>
