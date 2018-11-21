<?php
  if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['last_name']) ){
      $email = htmlspecialchars($_POST['email']);
      $password = md5(md5($_POST['password']));
      $check = md5(md5($_POST['check']));
      $name = htmlspecialchars($_POST['name']);
      $last_name = htmlspecialchars($_POST['last_name']);
      if ($password != $check){
        refresh('?view=signup&error=3');
        exit;
      }
      $query = 'SELECT id FROM `users` WHERE `email` ="'.$_POST['email'].'"';
      $res = $mysqli->query($query);
      if ($res->num_rows==0){
        $verification_key = md5(time()).generate_hash(40);
        $query = 'INSERT INTO `users` (`id`, `access`, `name`, `last_name`, `email`, `password`, `avatar`, `about`,`verification_key`)';
        $query.= ' VALUES (NULL, 0, "'.$name.'", "'.$last_name.'", "'.$email.'", "'.$password.'", "", "","'.$verification_key.'")';
        $res = $mysqli->query($query);
        if ($mysqli->insert_id != 0){
            $user_path = 'content/userdata/'.$mysqli->insert_id;
            mkdir($user_path);             //  создаем каталог
            chmod($user_path, 0777);
            mkdir($user_path.'/photo');             //  создаем каталог
            chmod($user_path.'/photo', 0777);
            mkdir($user_path.'/sketch');             //  создаем каталог
            chmod($user_path.'/sketch', 0777);
        }
        mail($email,'Подтверждение аккаунта '.date('Y-m-d H:i:s'),make_verify_mail($name,$verification_key),'Content-type: text/html; charset=utf-8\r\n'.'X-Mailer: PHP mail script');
      }else{
        refresh('?view=signup&error=1');
        exit;
      }
  }else{
    refresh('?view=signup&error=2');
    exit;
  }
 ?>
