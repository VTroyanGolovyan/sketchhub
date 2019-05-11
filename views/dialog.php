<?php include('./template/header.php'); ?>
<main class = "dialog-main">
<?php
   if (isset($_GET['type']) && $_GET['type'] == 0){
     $query = '';
     if (isset($_GET['user'])){
       $id1 = $_SESSION[$host]['id'];
       $id2 = (int)$_GET['user'];
       $query = 'SELECT * FROM `dialogs` WHERE type="0" AND ( (`id1`="'.$id1.'" AND `id2`="'.$id2.'") OR (`id1`="'.$id2.'" AND `id2`="'.$id1.'") ) LIMIT 1';
     }elseif(isset($_GET['id'])){
       $id1 = $_SESSION[$host]['id'];
       $dialogid = $_GET['id'];
       $query = 'SELECT * FROM `dialogs` WHERE `id`="'.$dialogid.'" LIMIT 1';
     }

     if ($query != ''){
       $res = $mysqli->query($query);
       if ($res->num_rows != 0){
        $dialog = $res->fetch_assoc();
        if ($id1 == $dialog['id1'] || $id1 == $dialog['id2']){
          if ($id1 == $dialog['id1']){
            $query = 'SELECT * FROM `users` WHERE `id`="'.$dialog['id2'].'"';
          } else $query = 'SELECT * FROM `users` WHERE `id`="'.$dialog['id1'].'"';
          $res2 = $mysqli->query($query);
          if ($res2->num_rows != 0){
            $interlocutor = $res2->fetch_assoc(); ?>
            <div class="dialog-top">
              <div class="avatar">
                <?php
                   if ($interlocutor['avatar'] == "")
                    $url = 'assets/img/default.png';
                else $url = $interlocutor['avatar'];
                ?>
                <img src="<?php print $url; ?>">
              </div>
              <div class="username">
                 <?php print $interlocutor['name'].' '.$interlocutor['last_name']; ?>
              </div>
            </div>
       <?php } ?>
           <div class="messages-list">
             <div class="comments">
          <?php
            $query = 'SELECT `messages`.*,`users`.`name`,`users`.`avatar` FROM `messages` INNER JOIN `users` ON `users`.`id` = `messages`.`sender` WHERE `dialog`="'.$dialog['id'].'" ORDER BY `id` ASC';
            $res = $mysqli->query($query);
            if ($res->num_rows != 0){
              while ($msg = $res->fetch_assoc()){
                print $msg['name'].' '.$msg['datetime'].' '.$msg['text'].'<br>';
              }
            }
          ?>
            </div>
          </div>
          <div class="send_panel">
            <form method="post" action="?cmd=messager&act=send&id=<?php print $dialog['id']; ?>&view=dialog&type=0">
              <textarea maxlength="2000" name="message" placeholder="Введите текст сообщения"></textarea>
              <label>
                <i class="fas fa-paper-plane"></i>
                <input type="submit" value="Отправить">
              </label>
            </form>
         </div>
    <?php
       }
      }else print 'Не ваш диалог';
     }
   }
   ?>
</main>
