<?php echo $header; ?>
<div class="article col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9">
    <h1><?php echo $lab['name']; ?></h1>
    <h2>Тема:</h2>
    <p><?php echo $lab['title']; ?></p>
    <h2>Мета:</h2>
    <p><?php echo $lab['target']; ?></p>
    <h2>Короткі відомості:</h2>
    <p><?php echo $lab['description']; if($is_login): ?></p>
    <h2>Можна завантажити</h2>
    <a href='/application/public/files/doc/<?php echo $lab['id']; ?>.doc' class="button">Завантажити<img src="/application/public/img/icon/download.png">.doc</a>
    <?php endif; ?>
</div>
<?php echo $footer ?>