<?php echo $header; ?>
<div class="article col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9">
    <h1><?php echo $lecture['title']; ?></h1>
    <img src="<?php echo $lecture['img']; ?>" alt="">
    <p><?php echo $lecture['description']; ?></p>
    <h2>Перегляд онлайн</h2>
    <iframe src="https://docs.google.com/viewer?url=http://itvol.nlf.name/application/public/files/pdf/<?php echo $lecture['id']; ?>.pdf&embedded=true" frameborder="0" height="700px" width="100%"></iframe>
    <?php if($is_login): ?>
    <h2>Можна завантажити</h2>
    <a href='/application/public/files/pdf/<?php echo $lecture['id']; ?>.pdf' class="button">Завантажити<img src="/application/public/img/icon/download.png">.pdf</a>
    <?php endif; ?>
</div>
<?php echo $footer ?>