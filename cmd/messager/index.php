<?php
  if (isset($_GET['act'])){
    switch ($_GET['act']) {
      case 'new_dialog':
          include('modules/edit.php');
        break;
      case 'message':
          include('modules/message.php');
        break;
    }
  }
?>
