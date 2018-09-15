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
  <section class = "search-form">
    <form method="post" action="?view=users">
      <input name="user" value="<?php print $user; ?>" placeholder = "Введите имя и/или фамилию пользователя" type = "text">
      <input value = "Поиск" type = "submit">
    </form>
  </section>
  <section class = "users">
  <?php
      if ($user != ''){
        if(strpos($user," ")){
          $arr = explode(" ",$user,2);
          $where = 'WHERE (`name` LIKE "%'.$arr[0].'%" and `last_name` LIKE "%'.$arr[1].'%") or (`name` LIKE "%'.$arr[0].'%" and `last_name` LIKE "%'.$arr[1].'%") ';
        }else{
          $where = 'WHERE `name` LIKE "%'.$user.'%" or `last_name` LIKE "%'.$user.'%" ';
        }
      }else $where = '';

      if (isset($_GET['page']))
         $page = (int)$_GET['page'];
      else $page = 1;
      $l = ($page-1)*12;
      $r = ($page)*12;

      $query = 'SELECT * FROM `users` '.$where.' ORDER BY `id` DESC LIMIT '.$l.','.$r;
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
<?php } ?>
   </section>
   <section>
   <?php
      $query = 'SELECT COUNT(*) FROM `users` '.$where;
      render_pages($mysqli,$query,12,'users');
    ?>
   </section>
</main>
<?php include('./template/footer.php'); ?>
