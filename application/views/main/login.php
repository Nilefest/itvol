<?php echo $header; ?>
<?php if(isset($mess)): ?>
<script>
    alert("<?php echo $mess; ?>");
</script>
<?php endif; ?>
<div class="article col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9">
    <h1>Увійти</h1>
    <p>Увійдіть до вашого особистого кабінету, щоб ваш прогрес зберігався</p>
    <form class="form" action="" method="post">
        <label for="login">Логін</label><br>
        <input type="text" id="login" name="login" placeholder="Введіть логін"><br>
        <label for="password">Пароль</label><br>
        <input type="password" id="password" name="password" placeholder="Введіть пароль"><br><br>
        <input type="submit" name="sub_login" value="Увійти">
        <a href="/register" class="button">Зареєструватися</a>
    </form>
</div>
<?php echo $footer ?>
