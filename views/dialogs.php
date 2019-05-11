<?php include('./template/header.php'); ?>
<main class="settings">
  <section class="dialogs-list">
<?php
  $join1 =  ' INNER JOIN `users` AS `u1` ON `u1`.`id` = `dialogs`.`id1` ';
  $join2 =  ' INNER JOIN `users` AS `u2` ON `u2`.`id` = `dialogs`.`id2` ';
  $datalist = '`dialogs`.*,`u1`.`id` AS `u1_id`,`u1`.`name` AS `u1_name`,`u1`.`last_name` AS `u1_last_name`,`u1`.`avatar` AS `u1_avatar`,`u2`.`id` AS `u2_id`,`u2`.`name` AS `u2_name`,`u2`.`last_name` AS `u2_last_name`,`u2`.`avatar` AS `u2_avatar`';
  $query = 'SELECT '.$datalist.' FROM `dialogs` '.$join1.' '.$join2.' WHERE `id1`="'.$_SESSION[$host]['id'].'" OR `id2`="'.$_SESSION[$host]['id'].'"';
  $res = $mysqli->query($query);
  if ($res->num_rows != 0){
    while ($dialog = $res->fetch_assoc()){
      ?>
      <a class="dialog" href="?view=dialog&type=0&id=<?php print $dialog['id']; ?>">
        <div class="dialog-avatar">
          <?php
            if ($_SESSION[$host]['id'] == $dialog['id1'])
              $prefix = 'u2_';
            else  $prefix = 'u1_';
            $avatar_url = 'assets/img/default.png';
            if ($dialog[$prefix.'avatar'] != '')
              $avatar_url = $dialog[$prefix.'avatar'];
          ?>
          <div class="img">
              <img src="<?php print $avatar_url; ?>">
          </div>
        </div>
        <div class="dialog-name">
          <?php
            print $dialog[$prefix.'name'].' '.$dialog[$prefix.'last_name'];
          ?>
        </div>
      </a>
<?php
    }
  }
 ?>
  </section>
</main>
<?php include('./template/footer.php'); ?>
