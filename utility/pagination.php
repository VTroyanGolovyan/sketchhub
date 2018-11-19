<?php
  function render_pages($mysqli,$query,$count_items,$view){
    ?>
    <section class="page-list">
    <?php
      $res = $mysqli->query($query);
      if ($res->num_rows != 0){
        $row = $res->fetch_assoc();
        $x = $row['COUNT(*)'];
        $count = (int)($x/$count_items);
        if($x-$count*$count_items > 0)
          $count++;
        if (isset($_GET['page'])){
          $now = $_GET['page'];
        }else{
          $now = 1;
        }
        for ($i = 1; $i <= $count; $i++){ ?>
           <a <?php if ($i == $now) print 'class="active"'; ?> href = "?view=<?php print $view; ?>&page=<?php print $i; ?>">
             <span>
               <?php print $i; ?>
             </span>
           </a>
<?php   }
      }
      ?>
    </section >
<?php
  }
?>
