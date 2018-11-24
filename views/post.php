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

      }
    }else{
      include('./views/404.php');
    }
  ?>
</main>
<?php include('./template/footer.php'); ?>
