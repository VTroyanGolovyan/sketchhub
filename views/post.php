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
        <div class="post-left">
          <img src="<?php print $post['full'] == "" ?  $post['url'] : $post['full']; ?>">
        </div>
        <div class="post-right">
          <div class="comment-form2">
            <form method="post" action="?cmd=comment&act=publish&id=<?php print $post['id']; ?>&view=post">
              <textarea name="text" placeholder="Введите текст коментария"></textarea>
              <label>
                <i class="fas fa-paper-plane"></i>
                <input type="submit" value="Отправить">
              </label>
            </form>
          </div>
          <div class="comments">
            <?php
              $query = 'SELECT `comments`.*,`users`.`name`,`users`.`avatar`,`users`.`last_name` FROM `comments` INNER JOIN `users` ON `users`.`id`=`comments`.`owner` WHERE `subject`="'.$post['id'].'"';
              $res=$mysqli->query($query);
              if ($res->num_rows != 0){
                while ($comment = $res->fetch_assoc()){
                   if ($comment['avatar'] == '')
                     $avatar = './assets/img/default.png';
                   else $avatar = $comment['avatar'];
                  ?>
                  <div class="comment">
                    <div class="left">
                      <img src="<?php print $avatar; ?>">
                    </div>
                    <div class="right">
                      <div class="user">
                        <?php print $comment['name'].' '.$comment['last_name']; ?>
                      </div>
                      <div class="date">
                          <?php print $comment['date']; ?>
                      </div>
                      <div class="text">
                          <?php print $comment['text']; ?>
                      </div>
                    </div>
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
