<?php echo $header; ?>
<div class="article col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <h1>Особистий кабінет Викладача</h1>
    <div class="admin_menu row"><a class="col-12 col-md-4" href="/teacher/lecture">Додати лекцію</a><a class="col-12 col-md-4" href="/teacher/test">Додати тест</a><a class="col-12 col-md-4" href="/teacher/lab">Додати лабораторну роботу</a></div>
    <h2>Створення Лабораторної роботи</h2>
    <p>Для створення лабораторної роботи на сайті, необхідно заповнити форму нижче й завантажити .doc (Word) документ роботи.</p>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Назва</label>
        <input type="text" name="name" id="name" placeholder="Лабораторна робота №..." value="Лабораторна робота ">
        <label for="title">Тема</label>
        <input type="text" name="title" id="title" placeholder="Тема">
        <label for="target">Мета</label>
        <input type="text" name="target" id="target" placeholder="Мета">
        <label for="tags">Позначки (через ',')</label>
        <input type="text" name="tags" id="tags" placeholder="Позначки">
        <label for="description">Короткий опис</label>
        <textarea name="description" id="description" placeholder="Короткий опис"></textarea>
        <label class="file blue" for="doc">Завантажити DOC документ роботи</label>
        <input type="file" name="doc" id="doc">
        <div class="clear"></div><br>
        <input class="green" type="submit" name="sub_add_lab" value="Додати роботу">
    </form>
    <h2>Усі лабораторні роботи на сайті на сайті</h2>
    <div class="table title_parent">
        <table class="admin">
            <tr>
                <th>Дата</th>
                <th>Тема</th>
                <th>Мета</th>
                <th>Теги</th>
                <th>Документ</th>
                <th></th>
            </tr>
            <?php foreach($labs as $lab): ?>
            <tr>
                <td><?php echo $lab['date']; ?></td>
                <td><a class="title" data-title="Опис: <?php echo substr($lab['target'], 0, 15); ?>..." href="/lab/<?php echo $lab['id']; ?>"><?php echo $lab['title']; ?></a></td>
                <td><?php echo $lab['target']; ?></td>
                <td class="tags">| <?php echo str_replace(',', ' | ', $lab['tags']); ?> |</td>
                <td><a target="_blank" class="file" href="/application/public/files/doc/<?php echo $lab['id']; ?>.doc">Завантажити</a></td>
                <td><a class="file red" href="/teacher/lab?rem_lab=<?php echo $lab['id']; ?>">Видалити</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php echo $footer ?>