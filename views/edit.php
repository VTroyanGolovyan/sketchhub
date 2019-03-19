<?php include('./template/header.php'); ?>
<main class="settings">
  <?php
     $id = $_SESSION[$host]['id'];
     $query = 'SELECT * FROM `users` WHERE `id`="'.$id.'"';
     $res = $mysqli->query($query);
     if ($res->num_rows != 0){
       $user = $res->fetch_assoc();
  ?>
  <div>
    <a>
      <i class="fas fa-info-circle"></i>Информация профиля
    </a>
  </div>
  <div>
    <form method="post" action="?cmd=user&act=edit" class="info">
      <textarea name = "status" placeholder="Статус"><?php print $user['about']; ?></textarea>
      <input type="submit" value="Изменить">
    </form>
  </div>
<?php } ?>
</main>
<?php include('./template/footer.php'); ?>
