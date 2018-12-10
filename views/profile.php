<?php include('./template/header.php'); ?>
<?php
  if (isset($_GET['id'])){
     $id = (int)$_GET['id'];
  }else{
    $id = $_SESSION[$host]['id'];
  }
  if (isset($_GET['type'])){
    $_SESSION[$host]['type'.$id] = (int)$_GET['type'];
  }
  if (isset($_SESSION[$host]['type'.$id])){
    $type = $_SESSION[$host]['type'.$id];
  }else $type = 0;
  $query = 'SELECT * FROM `users` WHERE `id`="'.$id.'"';
  $query2 = 'SELECT COUNT(*) AS `followers` FROM `followers` WHERE `object`="'.$id.'"';
  $query3 = 'SELECT COUNT(*) AS `following` FROM `followers` WHERE `follower`="'.$id.'"';
  $followers = $mysqli->query($query2)->fetch_assoc();
  $followers = $followers['followers'];
  $following = $mysqli->query($query3)->fetch_assoc();
  $following = $following['following'];
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
            <?php if ($user['id'] == $_SESSION[$host]['id']){ ?>
            <div class="avatar-mask">
              <label for = "avatar-file">Поменять</label>
              <a href="?cmd=unupload&act=avatar&view=profile">Удалить</a>
            </div>
            <?php } ?>
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
                 <b><?php print $followers; ?></b> Подписчики
               </a>
               <a href="?view=followers&id=<?php print $user['id']; ?>&type=1">
                 <b><?php print $following; ?></b> Подписки
               </a>
            </div>
            <div class = "profile-buttons">
              <?php if ($user['id'] == $_SESSION[$host]['id']){?>
              <label for = "photo-file">Добавить фотографию</label>
              <a href="?view=edit">Редактировать профиль</a>
              <form id="upload-photo" action="?cmd=upload&act=photo&view=profile" enctype = "multipart/form-data" method="post">
                <input id = "photo-file" onchange="submit()" name = "photo" type="file">
                <input type = "submit">
              </form>
            <?php }else{ ?>
              <?php if (is_follower($mysqli,$_SESSION[$host]['id'],$user['id'])){ ?>
                <a href = "?cmd=follow&act=un&id=<?php print $user['id']; ?>&view=profile">
                  Отписаться
                </a>
              <?php } else { ?>
                <a href = "?cmd=follow&act=in&id=<?php print $user['id']; ?>&view=profile">
                  Подписаться
                </a>
              <?php } ?>
              <a>
                Сообщение
              </a>
            <?php } ?>
            </div>
            <div class="about">
               UA Web-Developer 17 y.o.
            </div>
          </div>
        </header>
        <section class = "buttons">

           <div class="page">
             <?php if ($type == 0){ ?>
               <div class="line"></div>
             <?php } ?>
             <a href="?view=profile&id=<?php print $user['id']; ?>&type=0" class="item <?php if ($type == 0) print 'active'; ?>">
               <i class="fas fa-camera-retro"></i>Фото
             </a>
           </div>
           <div class="page">
             <?php if ($type == 1){ ?>
               <div class="line"></div>
             <?php } ?>
             <a href="?view=profile&id=<?php print $user['id']; ?>&type=1" class="item <?php if ($type == 1) print 'active'; ?>">
               <i class="fas fa-palette"></i>Скетчи
             </a>
           </div>
           <div class="page">
             <?php if ($type == 2){ ?>
               <div class="line"></div>
             <?php } ?>
             <a href="?view=profile&id=<?php print $user['id']; ?>&type=2" class="item <?php if ($type == 2) print 'active'; ?>">
               <i class="fab fa-mix"></i>Все
             </a>
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

       if ($type == 2){
         $query = 'SELECT * FROM `photos` WHERE `owner`="'.$id.'" ORDER BY `id` DESC LIMIT '.$l.','.$c;
       }else{
         $query = 'SELECT * FROM `photos` WHERE `owner`="'.$id.'" AND `type`="'.$type.'" ORDER BY `id` DESC LIMIT '.$l.','.$c;
       }
       $res = $mysqli->query($query);
       if ($res->num_rows != 0){
           while($photo = $res->fetch_assoc()){ ?>
             <a href="?view=post&id=<?php print $photo['id']; ?>" class = "photo">
               <div class = "mask">
                 <div class = "like"><?php print $photo['likes']; ?> <?php print correct_text(1,$photo['likes']); ?></div>
                 <div class = "coment"><?php print $photo['comments']; ?> <?php print correct_text(0,$photo['comments']); ?></div>
               </div>
               <img src = "<?php print $photo['url']; ?>">
             </a>
    <?php  }  ?>
      <?php } ?>
        </section>
    </main>
<?php } ?>
<section>
<?php
   if ($type == 2)
     $query = 'SELECT COUNT(*) FROM `photos` WHERE `owner`="'.$id.'"';
   else  $query = 'SELECT COUNT(*) FROM `photos` WHERE `owner`="'.$id.'" AND `type`="'.$type.'"';
   render_pages($mysqli,$query,12,'profile&type='.$type.'&id='.$id);
 ?>
</section>
<?php include_once('./template/footer.php'); ?>
