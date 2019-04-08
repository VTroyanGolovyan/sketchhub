<header class="header">
       <section class="logo">
         <h1>SketchHub</h1>
       </section>
       <nav>
         <a title="Рисовать" target="_blank" href="draw">
           <div><i class="fas fa-paint-brush"></i></div>
         </a>
         <a title="Люди" href="?view=users">
           <div><i class="fas fa-users"></i></div>
         </a>
         <a title="Лента" href="?view=news">
           <div><i class="fas fa-scroll"></i></div>
         </a>
         <a title="Профиль" href="?view=profile">
           <div><i class="fas fa-user"></i></div>
         </a>
         <a title="Выйти" href="?cmd=sign&act=out">
           <div><i class="fas fa-sign-out-alt"></i></div>
         </a>
         <a onclick="getEvents()">

           <label for="event-box"><i class="fas fa-bell"></i></label>
           <?php $k = get_events_count($mysqli,$_SESSION[$host]['id']); ?>
           <?php if ($k > 0){ ?>
           <div class="counter"><?php print $k; ?></div>
           <?php } ?>
         </a>
       </nav>
</header>
<input type="checkbox" id="event-box">
<div class="events">
  <div class="container">
    <div id="event-list" class="list-events">
    </div>
  </div>
</div>
