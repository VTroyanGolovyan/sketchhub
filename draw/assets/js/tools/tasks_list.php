<?php
  if (isset($_POST['name'])){
    $search = $_POST['name'];
    $_SESSION[$host]['search'] = htmlspecialchars($_POST['name']);
  } ?>
<main>
  <div class = "search-tasks-form">
  <?php if ($COMPETITION_ID == 0){ ?>
    <form id = "search_tasks" method="post" action="?view=tasks_list">
        <input name="name" type = "text" placeholder="Название задачи" value="<?php if (isset($_SESSION[$host]['search'])) print $_SESSION[$host]['search']; ?>">
        <?php
          $query = 'SELECT * FROM `problems_themes`';
          $res = $mysqli->query($query);

          while ($row = $res->fetch_assoc()) {
            if ($row['theme'] == 0) {
              $themes_array[$row['id']]['name'] = $row['name'];
            } else {
              $themes_array[$row['theme']]['subthemes'][$row['id']] = $row['name'];
            }
          }
          //print json_encode($themes_array);
       ?>
        <select name = "theme" onchange="submit('search_tasks')">
          <option value="0">
            Все темы
          </option>
          <?php foreach ($themes_array as $key => $value) { ?>
            <optgroup label = "  <?php print $value['name']; ?>">
                <?php $t = $value['name']; ?>
                <?php foreach ($value['subthemes'] as $key => $value) { ?>
                  <?php if (isset($_GET['theme']) && $_GET['theme'] == $key){ ?>
                     <option value="<?php print $key; ?>" selected>
                  <?php } elseif (isset($_POST['theme']) && $_POST['theme'] == $key){?>
                     <option value="<?php print $key; ?>" selected>
                 <?php } else { ?>
                     <option value="<?php print $key; ?> ">
                 <?php } ?>
                    <?php print $t.'/'.$value; ?>
                  </option>
                <?php } ?>
            </optgroup>
          <?php }?>
        </select>
        <input type="submit" value="Поиск">
    </form>
  <?php } ?>
  </div>
  <div class="tasks-list">
    <?php
      $count_page_items = 9;

      if (isset($_GET['page'])) {
        $l = ((int) $_GET['page'] - 1) * $count_page_items;
        $r = $_GET['page'] * $count_page_items;
      } else {
        $l = 0;
        $r = $count_page_items;
      }
      $f = false;
      $search_request = '';

      if (isset($_GET['theme']) && $_GET['theme']!=0) {
        $f = true;
        $search_request = '`subtheme`='.(int)$_GET['theme'];
      }

      if (isset($_POST['theme']) && !$f && $_POST['theme']!=0) {
        $f = true;
        $search_request = '`subtheme`='.(int)$_POST['theme'];
      }
      $search = '';

      if (isset($_SESSION[$host]['search'])) {
        $search = $_SESSION[$host]['search'];
      }

      if (isset($_POST['name'])) {
        $search = $_POST['name'];
        $_SESSION[$host]['search'] = htmlspecialchars($_POST['name']);
      }

      if ($search != '') {
        if ($f) {
          $search_request .= ' AND `name` LIKE "%'.$search.'%" ';
        } else {
          $search_request .= '`name` LIKE "%'.$search.'%" ';
        }
      }

      if ($COMPETITION_ID == 0) {
        if ($search_request != '') {
          $query = 'SELECT * FROM `problems` WHERE '. $search_request .' LIMIT '. $l .' , '. $count_page_items;
        } else {
          $query = 'SELECT * FROM `problems` LIMIT '. $l .' , '. $count_page_items;
        }
      } else {
        $query = 'SELECT * FROM `competitions_tasks` INNER JOIN `problems` ON `competitions_tasks`.`task_id` = `problems`.`id` WHERE `competition_id`='. $COMPETITION_ID .' LIMIT '. $l .', ' . $count_page_items;
      }

      $res = $mysqli->query($query);

      if ($res->num_rows != 0) {
        while ($row = $res->fetch_assoc()) {
        ?>
        <a href = "?view=task&id=<?php print $row['id']; ?>">
          <div class="task-list-element">
            <div >
              <span class="task-name"><?php print $row['name']; ?></span>
              <section>
                <img src="./assets/get_task_image.php?task_image_id=<?php print $row['id']; ?>" alt="task_image">
                <p><?php print $row['condition']; ?></p>
              </section>
            </div>
            <span class="task-details"><?php print $row['timeout'] . 'MS, ' . $row['memory'] . 'MB'; ?></span>
          </div>
        </a>
    <?php
        }
      }
    ?>
  </div>

  <div class = "pages-list">
    <?php

      $addlink = '';
      if (isset($_GET['theme']))
           $addlink = '&theme='.$_GET['theme'];
      if (isset($_POST['theme']))
           $addlink = '&theme='.$_POST['theme'];

      if ($COMPETITION_ID == 0) {
         if ($search_request != '') {
            $query = 'SELECT count(*) FROM `problems` WHERE '. $search_request;
         } else {
            $query = 'SELECT count(*) FROM `problems`';
         }
      } else {
         $query = 'SELECT count(*) FROM `competitions_tasks` ' ;
      }

      $res = $mysqli->query($query);

      if (isset($_GET['page'])) {
        $now = (int)$_GET['page'];
      } else {
        $now = 1;
      }

      if ($res->num_rows != 0) {
        $row = $res->fetch_assoc();
        $page_items_count = 9;//количество задач
        $count_pages = ($row['count(*)'] - $row['count(*)'] % $page_items_count) / $page_items_count; //количество страничек
        if ($count_pages > 12){ ?>
             <a <?php if (1 == $now) print 'class="active-page"'; ?> href = "?view=tasks-list&page=1<?php print $addlink; ?>">1</a>
         <?php
              if ($now <= 4){ //мы где-то в начале
                for ($i = 2; $i <= 6; $i++){ ?>
                   <a <?php if ($i == $now) print 'class="active-page"'; ?> href = "?view=tasks-list&page=<?php print $i; ?><?php print $addlink; ?>"><?php print $i; ?></a>

         <?php  }
                print '...';
              }
              if ($now > 4 && $now < $count_pages-4) { //мы где-то в середине
                  print '...';
                  for ($i = $now-2; $i <= $now + 2; $i++){ ?>
                     <a <?php if ($i == $now) print 'class="active-page"'; ?> href = "?view=tasks-list&page=<?php print $i; ?><?php print $addlink; ?>"><?php print $i; ?></a>
            <?php }
                  print '...';
              }
              if ($now >= $count_pages-4){ //мы где-то в конце
                print '...';
                for ($i =  $count_pages-5; $i < $count_pages; $i++){ ?>
                   <a <?php if ($i == $now) print 'class="active-page"'; ?> href = "?view=tasks-list&page=<?php print $i; ?><?php print $addlink; ?>"><?php print $i; ?></a>
         <?php  }
              }
              ?>

             <a <?php if ($count_pages == $now) print 'class="active-page"'; ?> href = "?view=tasks-list&page=<?php print $count_pages; ?><?php print $addlink; ?>"><?php print $count_pages; ?></a>
 <?php  }else{
           for ($i = 1; $i <= $count_pages; $i++){ ?>
             <a <?php if ($i == $now) print 'class="active-page"'; ?> href = "?view=tasks-list&page=<?php print $i; ?><?php print $addlink; ?>"><?php print $i; ?></a>
        <?php } ?>
  <?php } ?>
    <?php
      }
    ?>
  </div>
</main>
