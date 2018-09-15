<?php
if (!isset($_SESSION[$host]['id'])){
  $VIEW_LIST['signin'] = 'signin.php';
  $VIEW_LIST['signup'] = 'signup.php';
}
if (isset($_SESSION[$host]['id'])){
  $VIEW_LIST['profile'] = 'profile.php';
  $VIEW_LIST['users'] = 'users.php';
}
 ?>
