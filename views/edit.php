<?php include('./template/header.php'); ?>
<main class="settings">
  <?php
     $id = $_SESSION[$host]['id'];
     $query = 'SELECT * FROM `users` WHERE `id`="'.$id.'"';
     $res = $mysqli->query($query);
     if ($res->num_rows != 0){
       $user = $res->fetch_assoc();
  ?>
  <div class="edit-section">
    <div class="section-name">
        <i class="fas fa-info-circle"></i>Информация профиля
    </div>
    <div class="editor">
      <form method="post" action="?cmd=user&act=edit" class="info">
        <p>Изменить статус</p>
        <textarea maxlength="500" name = "status" placeholder="Статус"><?php print $user['about']; ?></textarea>
        <input type="submit" value="Изменить">
      </form>
    </div>
   </div>
   <div class="edit-section">
     <div class="section-name">
         <i class="fas fa-key"></i>Безопасность
     </div>
     <div class="editor">
       <form method="post" action="?cmd=user&act=chpass" class="info">
         <p>Изменить пароль</p>
         <input placeholder="Старый пароль" type="password" name="old">
         <input placeholder="Новый пароль" type="password" name="new">
         <input placeholder="Повторите еще раз" type="password" name="new_ch">
         <input type="submit" value="Изменить">
       </form>
     </div>
    </div>
<?php } ?>
</main>
<?php include('./template/footer.php'); ?>
