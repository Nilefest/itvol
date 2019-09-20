<?php echo $header; ?>
<div class="article col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <h1>Особистий кабінет Викладача</h1>
    <div class="admin_menu row"><a class="col-12 col-md-4" href="/teacher/lecture">Додати лекцію</a><a class="col-12 col-md-4" href="/teacher/test">Додати тест</a><a class="col-12 col-md-4" href="/teacher/lab">Додати лабораторну роботу</a></div>
    <h2>Створення Лекції</h2>
    <p>Для створення лекції на сайті, необхідно заповнити форму нижче й завантажити .pdf (якщо у Word -> Зберегти як -> Тип: .pdf) документ роботи.</p>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="title">Тема</label>
        <input type="text" name="title" id="title" placeholder="Тема">
        <label for="tags">Позначки (через ',')</label>
        <input type="text" name="tags" id="tags" placeholder="Позначки">
        <label for="description">Короткий опис</label>
        <textarea name="description" id="description" placeholder="Короткий опис"></textarea>
        <label class="file blue" for="img">Завантажити головне зображення (не обов'язково)</label>
        <input type="file" name="img" id="img">
        <label class="file blue" for="pdf">Завантажити PDF документ лекції</label>
        <input type="file" name="pdf" id="pdf">
        <div class="clear"></div><br>
        <input class="green" type="submit" name="sub_add_lecture" value="Додати лекцію">
    </form>
    <h2>Усі лекції на сайті</h2>
    <div class="table title_parent">
        <table class="admin">
            <tr>
                <th>Дата</th>
                <th>Тема</th>
                <th>Теги</th>
                <th>Документ</th>
                <th></th>
            </tr>
            <?php foreach($lectures as $lect): ?>
            <tr>
                <td><?php echo $lect['date']; ?></td>
                <td><a class="title" data-title="Коротка інформація: <?php echo $lect['description']; ?>" href="/lecture/<?php echo $lect['id']; ?>"><?php echo $lect['title']; ?></a></td>
                <td class="tags">| <?php echo str_replace(',', ' | ', $lect['tags']); ?> |</td>
                <td><a target="_blank" class="file" href="/application/public/files/pdf/<?php echo $lect['id']; ?>.pdf">Завантажити</a></td>
                <td><a class="file red" href="/teacher/lecture?rem_lecture=<?php echo $lect['id']; ?>">Видалити</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php echo $footer ?>