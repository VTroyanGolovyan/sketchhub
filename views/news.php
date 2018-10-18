<?php include('./template/header.php'); ?>
<main class="main-news">
  <section class="news">
   <?php
      $query = 'SELECT `photos`.*,`users`.`name`,`users`.`last_name`,`users`.`avatar` FROM `photos` INNER JOIN `users` ON `photos`.`owner`=`users`.`id`  WHERE (`owner` IN (SELECT `object` FROM `followers` WHERE `follower`="'.$_SESSION[$host]['id'].'")) or `owner` = "'.$_SESSION[$host]['id'].'" ORDER BY `posted` DESC';
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
     }
 ?>
  </section>
  <section class="news-nav">
    ds
  </section>
</main>
<?php include('./template/footer.php'); ?>
