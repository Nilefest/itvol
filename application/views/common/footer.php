<div class="mobile block news row">
    <h3 class="col-12">Останні оновлення</h3>
    <ul>
        <?php $n = 0; foreach($news as $one): if($n++ == 10) break; ?>
        <li><a href="/<?php echo $one['type']; ?>/<?php echo $one['id']; ?>"><?php echo $one['title']; ?></a> <span class="date">[<?php echo $one['date']; ?>]</span></li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="mobile block tags row">
    <h3 class="col-12">Теги</h3>
    <ul>
        <?php foreach($tags as $one): ?>
        <li><a href="/search/<?php echo $one; ?>"><?php echo $one; ?></a>,</li>
        <?php endforeach; ?>
    </ul>
    <br>
    <div class="clear"></div>
</div>
<div class="mobile block social row">
    <h3 class="col-12">Поділитись:</h3>
    <div class="pluso" data-background="transparent" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="facebook,twitter,linkedin,pinterest,bookmark,email,print"></div>
    <br>
</div>
</div>
<footer class="row">
    <div class="copyright col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        Copyright © 2019 ITVol
    </div>
</footer>
</div>
<!-- Custom JS -->
<script src="/application/public/js/script.js"></script>
<?php foreach($js as $script):?>
<script src="/application/public/js/<?php echo $script;?>.js" type="text/javascript" charset="utf-8"></script>
<?php endforeach; ?>
</body>

</html>
