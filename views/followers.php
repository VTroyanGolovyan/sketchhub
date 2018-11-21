<?php include('./template/header.php'); ?>
<main class = "users-main">
  <?php
     if (isset($_POST['user'])){
        $user = htmlspecialchars($_POST['user']);
        $_SESSION[$host]['users_search'] = $_POST['user'];
     }elseif(isset($_SESSION[$host]['users_search'])){
        $user = $_SESSION[$host]['users_search'];
     }else $user = '';
   ?>
  <section class = "users">
  <?php
      if (isset($_GET['id'])){
        $id = $_GET['id'];
      } else $id = $_SESSION[$host]['id'];
      if ($_GET['type'] == 0){
        $where = 'WHERE `object`="'.$id.'"';
        $join =  'INNER JOIN `users` ON `users`.`id`=`followers`.`follower`';
      } else {
        $where = 'WHERE `follower`="'.$id.'"';
        $join =  'INNER JOIN `users` ON `users`.`id`=`followers`.`object`';
      }
      $query = 'SELECT * FROM `followers` '.$join.' '.$where.' ORDER BY `users`.`id`';
      $res = $mysqli->query($query);

      if ($res->num_rows !=0){
        while ($user = $res->fetch_assoc()){ ?>
         <div class="user">
           <a href = "?view=user&id=<?php print $user['id']; ?>">
             <div class="user-avatar">
               <?php
                if ($user['avatar'] == "")
                  $url = 'assets/img/default.png';
                else $url = $user['avatar'];
               ?>
               <img src = "<?php print $url; ?>">
             </div>
             <div class="user-name">
               <?php print $user['name'].' '.$user['last_name']; ?>
             </div>
           </a>
         </div>
  <?php } ?>
<?php }else{ ?>
  <?php  if ($_GET['type'] == 0){ ?>
             К сожалению у этого пользователя нет подписчиков.
  <?php  }else{ ?>
             К сожалению у этого пользователя нет подписок.
  <?php  } ?>
<?php } ?>
   </section>
   <section>
   <?php
      $query = 'SELECT COUNT(*) FROM `users` '.$where;
    //  render_pages($mysqli,$query,12,'users');
    ?>
   </section>
</main>

<?php include('./template/footer.php'); ?>
