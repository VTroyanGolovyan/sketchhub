<?php
  if (isset($_GET['act'])){
    switch ($_GET['act']) {
      case 'new_dialog':
          include('modules/new_dialog.php');
        break;
      case 'send':
          include('modules/send.php');
        break;
    }
  }
?>
