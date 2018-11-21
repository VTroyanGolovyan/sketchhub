<?php
if (!isset($_SESSION[$host]['id'])){
  $VIEW_LIST['signin'] = 'signin.php';
  $VIEW_LIST['signup'] = 'signup.php';
  $VIEW_LIST['forgot'] = 'forgot.php';
}
if (isset($_SESSION[$host]['id'])){
  $VIEW_LIST['profile'] = 'profile.php';
  $VIEW_LIST['users'] = 'users.php';
  $VIEW_LIST['news'] = 'news.php';
  $VIEW_LIST['followers'] = 'followers.php';
  $VIEW_LIST['edit'] = 'edit.php';
  $VIEW_LIST['post'] = 'post.php';
}
 ?>
