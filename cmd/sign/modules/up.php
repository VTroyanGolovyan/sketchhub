<?php
  if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['last_name']) ){
      $email = htmlspecialchars($_POST['email']);
      $password = md5(md5($_POST['password']));
      $name = htmlspecialchars($_POST['name']);
      $last_name = htmlspecialchars($_POST['last_name']);

      $query = 'INSERT INTO `users` (`id`, `access`, `name`, `last_name`, `email`, `password`, `avatar`, `about`)';
      $query.= ' VALUES (NULL, 10, "'.$name.'", "'.$last_name.'", "'.$email.'", "'.$password.'", "", "")';
      $res = $mysqli->query($query);
      $query = 'SELECT `id` FROM `users` ORDER BY `id` DESC LIMIT 1';
      $res = $mysqli->query($query);
      if ($res->num_rows != 0){
          $row = $res->fetch_assoc();
          $user_path = 'content/userdata/'.$row['id'];
          mkdir($user_path);             //  создаем каталог
          chmod($user_path, 0777);
          mkdir($user_path.'/photo');             //  создаем каталог
          chmod($user_path.'/photo', 0777);
          mkdir($user_path.'/sketch');             //  создаем каталог
          chmod($user_path.'/sketch', 0777);
      }
  }
 ?>
