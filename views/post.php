<?php include('./template/header.php'); ?>
<main class="post-main">
  <?php
    if (isset($_GET['id'])){
      $id = (int)$_GET['id'];
      $query = 'SELECT * FROM `photos` WHERE `id`="'.$id.'"';
      $res = $mysqli->query($query);
      if ($res->num_rows == 0){
        include('./views/404.php');
      }else{
        $post = $res->fetch_assoc();
        ?>
        <div>
          <img src="<?php print $post['url']; ?>">
        </div>
        <div>
          <div class="comment-form">
            <form method="post" action="?cmd=comment&act=publish&id=<?php print $post['id']; ?>&view=post">
              <textarea name="text" placeholder="Введите текст коментария"></textarea>
              <input type="submit" value="Отправить">
            </form>
          </div>
          <div>
            <?php
              $query = 'SELECT `comments`.*,`users`.`name` FROM `comments` INNER JOIN `users` ON `users`.`id`=`comments`.`owner` WHERE `subject`="'.$post['id'].'"';
              $res=$mysqli->query($query);
              if ($res->num_rows != 0){
                while ($comment = $res->fetch_assoc()){
                  ?>
                  <div>
                      <?php print $comment['name']; ?>
                      <?php print $comment['text']; ?>
                  </div>
                  <?php
                }
              }else{
                ?>
                <div>
                  Еще никто не прокоментировал этот пост
                </div>
                <?php
              }

            ?>
          </div>
        </div>
        <?php
      }
    }else{
      include('./views/404.php');
    }
  ?>
</main>
<?php include('./template/footer.php'); ?>
