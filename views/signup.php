<main class="main-login">
      <section>
        <h1>SketchHub</h1>
        <form action="?cmd=sign&act=up&view=signin" method="post">
          <input name = "name" type = "text" placeholder="Имя" required>
          <input name = "last_name" type = "text" placeholder="Фамилия" required>
          <input name = "email" type = "email" placeholder="Почта" required>
          <input name = "password" type="password" placeholder="Пароль" required>
          <input name = "check" type="password" placeholder="Повторите пароль" required>
          <input type = "submit" value="Зарегистрироваться">
        </form>
        <a href="?view=signin"> Есть аккаунт? Войдите! </a>
      </section>
</main>
