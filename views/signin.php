<main class="main-login">
    <section>
      <h1>SketchHub</h1>
      <form action="?cmd=sign&act=in&view=profile" method="post">
        <input name = "email" type = "email" placeholder="Почта" required>
        <input name = "password" type="password" placeholder="Пароль" required>
        <input type = "submit" value="Войти">
      </form>
      <a href="?reg"> Забыли пароль? Востановите! </a>
      <a href="?view=signup"> Нет аккаунта? Зарегистрируйтесь! </a>
    </section>
</main>
<?php include('./template/footer.php'); ?>
