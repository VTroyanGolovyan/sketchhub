<?php
  if (isset($_GET['id'])) {
    $dialogid = (int)$_GET['id'];
    $query = 'SELECT * FROM `dialogs` WHERE `id`="'.$dialogid.'" LIMIT 1';
    $res = $mysqli->query($query);
    if ($res->num_rows !=0){
      $dialog = $res->fetch_assoc();
      $id1 = $_SESSION[$host]['id'];
      if ($dialog['id1'] == $id1 || $dialog['id2'] == $id1){
        $message = htmlspecialchars($_POST['message']);
        $query = 'INSERT INTO `messages` (`id`,`dialog`,`sender`,`datetime`,`text`) VALUES ';
        $query.= '(NULL,"'.$dialogid.'","'.$id1.'","'.date('Y-m-d H:i:s').'","'.$message.'")';
        $mysqli->query($query);
      }
    }
  }
?>
