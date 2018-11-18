<?php include('./template/header.php'); ?>
<main class="main-news">
  <section class="news">
   <?php
      if (isset($_GET['page'])){
        $p = (int)$_GET['page'];
        $l = ($p-1)*12;
        $r = $p*12;
      }else{
        $l = 0;
        $r = 12;
      }
      $query = 'SELECT `photos`.*,`users`.`name`,`users`.`last_name`,`users`.`avatar` FROM `photos`
                INNER JOIN `users` ON `photos`.`owner`=`users`.`id`
                WHERE (`owner` IN (SELECT `object` FROM `followers` WHERE `follower`="'.$_SESSION[$host]['id'].'")) or `owner` = "'.$_SESSION[$host]['id'].'" ORDER BY `posted` DESC LIMIT '.$l.','.$r;
      $res = $mysqli->query($query);
      if ($res->num_rows != 0){
        while ($row = $res->fetch_assoc()){ ?>
          <article class="news-item">
            <div>
              <div class="publisher">
                <div class="avatar">
                  <img src="<?php print $row['avatar']; ?>">
                </div>
                <div class="name">
                  <?php print $row['name'].' '.$row['last_name']; ?>
                </div>
              </div>
            </div>
            <div class="image">
              <img src = "<?php print $row['url']; ?>"><br>
            </div>
            <div class="info">
              <div class="counters">
                <div>
                  Лайки: 0
                </div>
                <div>
                  Коменты: 0
                </div>
              </div>
              <div class="date">
                 <?php print $row['posted']; ?>
              </div>
            </div>
          </article>

<?php  }
}else{
  ?>
  <article class="news-item">
      <div class="info">
    Вы ни на кого не подписаны или никто ничего не опубликовал
      </div>
  </article>
  <?php
}
 ?>
  </section>
  <section class="news-nav">
    <div class="news-nav-section">
    <?php
      $id = $_SESSION[$host]['id'];

      $where = 'WHERE `follower`="'.$id.'"';
      $join =  'INNER JOIN `users` ON `users`.`id`=`followers`.`object`';

      $query = 'SELECT * FROM `followers` '.$join.' '.$where.' ORDER BY `users`.`id` LIMIT 6';
      $res = $mysqli->query($query);
      if ($res->num_rows != 0){
        while ($user = $res->fetch_assoc()){
          ?>
          <a class="user-link" href="#id1">
            <div class="user-link-left">
              <?php
                if ($user['avatar'] == "")
                  $url = 'assets/img/default.png';
                else $url = $user['avatar'];
              ?>
              <img src="<?php print $url; ?>">
            </div>
            <div class="user-link-right">
              <?php print $user['name'].' '.$user['last_name']; ?>
            </div>
          </a>
          <?php
        }
      }
    ?>
    </div>
    <div class="news-nav-section">
      <div class="reclam">
        <img width="100%" src="./assets/img/d.jpg">
      </div>
    </div>
  </section>
</main>
<section>
<?php
   $query = 'SELECT COUNT(*) FROM `photos` WHERE (`owner` IN (SELECT `object` FROM `followers` WHERE `follower`="'.$_SESSION[$host]['id'].'")) or `owner` = "'.$_SESSION[$host]['id'].'"';
   render_pages($mysqli,$query,12,'news');
 ?>
</section>
<?php include('./template/footer.php'); ?>
