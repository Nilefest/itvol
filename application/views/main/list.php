<?php echo $header; ?>
<div class="article col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9">
    <h1><?php echo $list_type; ?></h1>
    <?php if(isset($tag)): ?>
    <h2>пошуки за тегом: <b class="teg"><?php echo $tag; ?></b></h2>
    <?php endif; ?>
    <?php foreach($list as $one): ?>
    <div class="block tags">
        <h2><?php echo $one['title']; ?></h2>
        <img class="about" src="<?php echo $one['img']; ?>" alt="art1">
        <p><?php echo substr($one['description'], 0, 20); ?>...</p>
        <ul>
            <?php foreach($one['tags'] as $tag): ?>
            <li><a href="/search/<?php echo trim($tag); ?>"><?php echo trim($tag); ?></a>,</li>
            <?php endforeach; ?>
        </ul>
        <a href="/<?php echo $one['type']; ?>/<?php echo $one['id']; ?>" class="button">Перейти...</a>
        <div class="clear"></div>
    </div>
    <?php endforeach; ?>
</div>
<?php echo $footer ?>