<?php echo $header; ?>
<?php if(isset($mess)): ?>
<script>
    alert("<?php echo $mess; ?>");
</script>
<?php endif; ?>
<div class="article col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <h1>Особистий кабінет Адміністратора</h1>
    <p>На цій сторінці ви можете видаляти та додавати користувачів власноруч</p>
    <div class="table">
        <table class="admin">
            <tr>
                <th>#</th>
                <th>ПІП</th>
                <th>Логін</th>
                <th>Ел. пошта</th>
                <th>Тип</th>
                <th>Дата реєстрації</th>
                <th></th>
            </tr>
            <?php $n = 0; foreach($users as $one): ?>
            <tr>
                <form action="" method="post">
                    <td><?php echo $n++; ?></td>
                    <td><input type="text" name="name" value="<?php echo $one['name']; ?>" placeholder="Прізвище, ім'я..."></td>
                    <td><input type="text" name="login" value="<?php echo $one['login']; ?>" placeholder="Логін"></td>
                    <td><input type="email" name="mail" value="<?php echo $one['mail']; ?>" placeholder="Mail"></td>
                    <td><?php echo $type_lvl[$one['lvl']]; ?></td>
                    <td><?php echo $one['date']; ?></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $one['id']; ?>">
                        <input class="blue" type="submit" name="sub_save_user" value="Зберегти">
                        <input class="red" type="submit" name="sub_rem_user" value="Видалити">
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <h2>Заяви на реєстрацію викладачів</h2>
    <div class="table">
        <table class="admin">
            <tr>
                <th>#</th>
                <th>ПІП</th>
                <th>Логін</th>
                <th>Ел. пошта</th>
                <th>Дата реєстрації</th>
                <th></th>
            </tr>
            <?php $n = 0; foreach($teach_state as $teach): ?>
            <tr>
                <form action="" method="post">
                    <td><?php echo $n++; ?></td>
                    <td><input type="text" name="name" value="<?php echo $teach['name']; ?>" placeholder="Прізвище, ім'я..."></td>
                    <td><input type="text" name="login" value="<?php echo $teach['login']; ?>" placeholder="Логін"></td>
                    <td><input type="email" name="mail" value="<?php echo $teach['mail']; ?>" placeholder="Mail"></td>
                    <td><?php echo $teach['date']; ?></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $teach['id']; ?>">
                        <input class="blue" type="submit" name="sub_save_teacher" value="Прийняти">
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <h2>Додати користувача</h2>
    <div class="table">
        <table class="admin">
            <tr>
                <th>ПІП</th>
                <th>Логін</th>
                <th>Пароль</th>
                <th>Електрона пошта</th>
                <th>Рівень доступу</th>
                <th></th>
            </tr>
            <tr>
                <form action="" method="post">
                    <td><input type="text" name="name" placeholder="Прізвище, ім'я..."></td>
                    <td><input type="text" name="login" placeholder="Логін"></td>
                    <td><input type="text" name="password" placeholder="Пароль"></td>
                    <td><input type="email" name="mail" placeholder="Mail"></td>
                    <td>
                        <select name="lvl" id="lvl_type">
                            <option value="0">Адміністратор</option>
                            <option value="1">Викладач</option>
                            <option value="2">Студент</option>
                        </select>
                    </td>
                    <td>
                        <input class="blue" type="submit" name="sub_add_user" value="Створити">
                    </td>
                </form>
            </tr>
        </table>
    </div>
</div>
<?php echo $footer ?>