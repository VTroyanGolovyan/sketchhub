<?php
    $CMD_LIST['sign'] = 'sign';
    if (isset($_SESSION[$host]['id'])){
      $CMD_LIST['upload'] = 'upload';
      $CMD_LIST['unupload'] = 'unupload';
      $CMD_LIST['follow'] = 'follow';
      $CMD_LIST['user'] = 'user';
      $CMD_LIST['comment'] = 'comment';
      $CMD_LIST['messager'] = 'messager';
    }
 ?>
