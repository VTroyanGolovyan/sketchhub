<?php
  if (isset($_GET['act'])){
    switch ((int)$_GET['act']) {
      case 'publish':
          include('modules/publish.php');
        break;

      default:
        // code...
        break;
    }
  }
 ?>
