<?php echo $header; ?>
<?php if(isset($mess)): ?>
<script>
    alert("<?php echo $mess; ?>");
</script>
<?php endif; ?>
<div class="article col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9">
    <h1>Зареєструватися</h1>
    <p>Зареєструйтесь та увійдіть до вашого особистого кабінету, щоб ваш прогрес зберігався</p>
    <form class="form" action="" method="post">
        <label for="name">ПІП</label><br>
        <input type="text" id="name" name="name" placeholder="Прізвище, ім'я"><br>
        <label for="mail">Електронна пошта</label><br>
        <input type="email" id="mail" name="mail" placeholder="email"><br>
        <label for="login">Логін</label><br>
        <input type="text" id="login" name="login" placeholder="Введіть логін"><br>
        <label for="password">Пароль</label><br>
        <input type="password" id="password" name="password" placeholder="Введіть пароль"><br>
        <label for="type">Тип запису</label><br>
        <select name="lvl" id="lvl">
            <option selected value="2">Студент</option>
            <option value="1">Викладач</option>
        </select><br><br>
        <input type="submit" name="sub_register" value="Зареєструватися">
        <a href="/login" class="button">Увійти</a>
    </form>
</div>
<?php echo $footer ?>
