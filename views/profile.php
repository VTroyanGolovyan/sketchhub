<?php include('./template/header.php'); ?>
<?php
  if (isset($_GET['id'])){
     $id = (int)$_GET['id'];
  }else{
    $id = $_SESSION[$host]['id'];
  }
  $query = 'SELECT * FROM `users` WHERE `id`="'.$id.'"';
  $res = $mysqli->query($query);
  if ($res->num_rows != 0){
    $user = $res->fetch_assoc();
?>

<main class="main-profile">
        <header>
          <?php
             if ($user['avatar'] == "")
                 $url = 'assets/img/default.png';
             else $url = $user['avatar'];
           ?>
          <div class="avatar">
            <div class="avatar-mask">
              <label for = "avatar-file">Поменять</label>
              <label>Удалить</label>
            </div>
            <form id="upload-avatar" action="?cmd=upload&act=avatar&view=profile" enctype = "multipart/form-data" method="post">
              <input id = "avatar-file" onchange="submit()" name = "avatar" type="file">
              <input type = "submit">
            </form>
            <img src = "<?php print $url; ?>">
          </div>
          <div class="info">
            <div class="name"><?php print $user['name'].' '.$user['last_name']; ?></div>
            <div class = "profile-buttons">
              <?php if ($user['id'] == $_SESSION[$host]['id']){?>
              <label for = "photo-file">Добавить фотографию</label>
              <label>Редактировать профиль</label>
              <form id="upload-photo" action="?cmd=upload&act=photo&view=profile" enctype = "multipart/form-data" method="post">
                <input id = "photo-file" onchange="submit()" name = "photo" type="file">
                <input type = "submit">
              </form>
            <?php }else{ ?>
              <label for = "photo-file">Подписаться</label>
              <label for = "photo-file">Сообщение</label>
            <?php } ?>
            </div>
          </div>
        </header>
        <section class = "buttons">
           <div>
             Скетчи
           </div>
           <div>
             Фото
           </div>
        </section>

        <section class = "galery">
    <?php
       $query = 'SELECT * FROM `photos` WHERE `owner`="'.$id.'" ORDER BY `id` DESC';
       $res = $mysqli->query($query);
       if ($res->num_rows != 0){
           while($photo = $res->fetch_assoc()){ ?>
             <div class = "photo">
               <div class = "mask">
                 <div class = "like">0 лайков</div>
                 <div class = "coment">0 коментариев</div>
               </div>
               <img src = "<?php print $photo['url']; ?>">
             </div>
    <?php  }  ?>
      <?php } ?>
        </section>
    </main>
<?php } ?>
<?php include_once('./template/footer.php'); ?>
