<?php echo $header; ?>
<div class="article col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <h1>Особистий кабінет Викладача</h1>
    <div class="admin_menu row"><a class="col-12 col-md-4" href="/teacher/lecture">Додати лекцію</a><a class="col-12 col-md-4" href="/teacher/test">Додати тест</a><a class="col-12 col-md-4" href="/teacher/lab">Додати лабораторну роботу</a></div>
    <h2>Створення Тесту</h2>
    <p>Для створення тесту на сайті, необхідно заповнити <a href="/application/public/files/excel/0.xlsx">шаблон .xls (Excel)</a> тесту й завантажити, скориставшись формою нижче.</p>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="title">Назва</label>
        <input type="text" name="title" id="title" placeholder="Тест №..." value="Тест ">
        <label for="tags">Позначки (через ',')</label>
        <input type="text" name="tags" id="tags" placeholder="Позначки">
        <label for="description">Короткий опис</label>
        <textarea name="description" id="description" placeholder="Короткий опис"></textarea>
        <label class="file blue" for="excel">Завантажити Excel докумен тесту</label>
        <input type="file" name="excel" id="excel">
        <div class="clear"></div><br>
        <input class="green" type="submit" name="sub_add_test" value="Додати тест">
    </form>
    <h2>Усі тести на сайті</h2>
    <div class="table title_parent">
        <table class="admin">
            <tr>
                <th>Дата</th>
                <th>Тема</th>
                <th>Теги</th>
                <th></th>
            </tr>
            <?php foreach($tests as $test): ?>
            <tr>
                <td><?php echo $test['date']; ?></td>
                <td><a class="title" data-title="Опис: <?php echo $test['description']; ?>" href="/test/<?php echo $test['id']; ?>"><?php echo $test['title']; ?></a></td>
                <td class="tags">| <?php echo str_replace(',', ' | ', $test['tags']); ?> |</td>
                <td><a class="file red" href="/teacher/test?rem_test=<?php echo $test['id']; ?>">Видалити</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php echo $footer ?>