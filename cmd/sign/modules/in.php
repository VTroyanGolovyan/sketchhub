<?php
  if (isset($_POST['email']) && isset($_POST['password'])){
    $email = htmlspecialchars($_POST['email']);
    $password = md5(md5(htmlspecialchars($_POST['password'])));
    $query = 'SELECT `id`,`access`,`password` FROM `users` WHERE email = "'.$email .'" LIMIT 1';
    $rez = $mysqli->query($query);
    if ($rez->num_rows != 0){
      $row = $rez->fetch_assoc();
      if ($row['password'] == $password){
        $_SESSION[$host]['id'] = $row['id'];
        $_SESSION[$host]['access'] = $row['access'];
      }
    }
  }
 ?>
