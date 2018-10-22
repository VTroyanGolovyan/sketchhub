<?php
  require_once('../config/config.php'); //конфигурация сайта

  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);

  require_once('../utility/image_worker.php');
  require_once('../utility/functions.php');
  require_once('../utility/pagination.php');
  require_once('../db/db.php');
  session_start();
 ?>
