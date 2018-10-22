<main class="main-login">
    <section>
      <h1>SketchHub</h1>
      <form action="?cmd=sign&act=in&view=profile" method="post">
        <input name = "email" type = "email" placeholder="Почта" required>
        <input type = "submit" value="Востановить">
      </form>
      <a href="?view=signin"> Вспомнили пароль? Войдите! </a>
      <a href="?view=signup"> Нет аккаунта? Зарегистрируйтесь! </a>
    </section>
</main>
<?php include('./template/footer.php'); ?>
