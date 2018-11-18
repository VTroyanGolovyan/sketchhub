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
              <a href="?cmd=unupload&act=avatar&view=profile">Удалить</a>
            </div>
            <form id="upload-avatar" action="?cmd=upload&act=avatar&view=profile" enctype = "multipart/form-data" method="post">
              <input id = "avatar-file" onchange="submit()" name = "avatar" type="file">
              <input type = "submit">
            </form>
            <img src = "<?php print $url; ?>">
          </div>
          <div class="info">
            <div class="name"><?php print $user['name'].' '.$user['last_name']; ?></div>
            <div class = "followers-following">
               <a href="?view=followers&id=<?php print $user['id']; ?>&type=0">
                 <b><?php print $user['followers']; ?></b> Подписчики
               </a>
               <a href="?view=followers&id=<?php print $user['id']; ?>&type=1">
                 <b><?php print $user['following']; ?></b> Подписки
               </a>
            </div>
            <div class = "profile-buttons">
              <?php if ($user['id'] == $_SESSION[$host]['id']){?>
              <label for = "photo-file">Добавить фотографию</label>
              <label>Редактировать профиль</label>
              <form id="upload-photo" action="?cmd=upload&act=photo&view=profile" enctype = "multipart/form-data" method="post">
                <input id = "photo-file" onchange="submit()" name = "photo" type="file">
                <input type = "submit">
              </form>
            <?php }else{ ?>
              <a href = "?cmd=follow&act=in&id=<?php print $user['id']; ?>&view=profile">
                <label>Подписаться</label>
              </a>
              <a>
                <label>Сообщение</label>
              </a>
            <?php } ?>
            </div>
            <div class="about">
               UA Web-Developer 17 y.o.
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
      if (isset($_GET['page'])){
        $p = (int)$_GET['page'];
        $l = ($p-1)*12;
        $c = 12;
      }else{
        $l = 0;
        $c = 12;
      }
       $query = 'SELECT * FROM `photos` WHERE `owner`="'.$id.'" ORDER BY `id` DESC LIMIT '.$l.','.$c;

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
<section>
<?php
   $query = 'SELECT COUNT(*) FROM `photos` WHERE `owner`="'.$id.'"';
   render_pages($mysqli,$query,12,'profile&id='.$id);
 ?>
</section>
<?php include_once('./template/footer.php'); ?>
