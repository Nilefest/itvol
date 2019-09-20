<!DOCTYPE html>
<html lang="ru ua">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description ?>">
    <meta name="keywords" content="<?php echo $keywords ?>">

    <title><?php echo $tag ?> | <?php echo $title ?></title>

    <!-- Library CSS -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"><!---->
    <!--<link rel="stylesheet" href="/application/public/css/bootstrap.css"><!---->


    <!-- Library JS -->
    <!-- jQuery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><!---->
    <!--<script src="/application/public/js/jquery.js" type="text/javascript" charset="utf-8"></script><!---->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/application/public/css/style.css">
    <?php if(isset($css)): foreach($css as $style):?>
    <link href="/application/public/css/<?php echo $style;?>.css" rel="stylesheet">
    <?php endforeach; endif; ?>
    
</head>

<body>
    <div class="container">
        <header class="row">
            <a href="/">
                <h1 class="col-12">
                    <span class="main">IT</span>Vol
                </h1>
            </a>
            <?php if(!empty($user)): ?>
            <div class="personal">
                <a href="<?php echo $type_user[$user['lvl']]; ?>">До кабінету <b><?php echo $user['name']; ?></b>!</a>
            </div>
            <?php endif; ?>
            <div class="info col-12">Навчайся вже зараз. Обери свій шлях сам</div>
            <nav class="col-12">
                <ul class="menu row">
                    <li class="menu__item col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3"><a href="/lecture">Лекції</a>
                        <ul class="sub">
                            <?php foreach($lecture as $one): ?>
                            <li><a href="/lecture/<?php echo $one['id']; ?>"><?php echo $one['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="menu__item col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3"><a href="/test">Тести</a>
                        <ul class="sub">
                            <?php foreach($test as $one): ?>
                            <li><a href="/test/<?php echo $one['id']; ?>"><?php echo $one['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="menu__item col-12 col-sm-4 col-md-4 col-lg-3 col-xl-3"><a href="/lab">Лабораторні роботи</a>
                        <ul class="sub">
                            <?php foreach($lab as $one): ?>
                            <li><a href="/lab/<?php echo $one['id']; ?>"><?php echo $one['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="menu__item col-12 col-sm-2 col-md-2 col-lg-3 col-xl-3"><a href="/login<?php echo (!empty($user)?'?logout':''); ?>"><?php echo (!empty($user)?'Вийти':'Увійти'); ?></a></li>
                </ul>
                <ul class="mobile mobile_menu">
                    <li class=""></li>
                    <li class=""><span class="a open_sub">Лекції</span>
                        <ul class="sub">
                            <?php foreach($lecture as $one): ?>
                            <li><a href="/lecture/<?php echo $one['id']; ?>"><?php echo $one['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class=""><span class="a open_sub">Лабораторні роботи</span>
                        <ul class="sub">
                            <?php foreach($lab as $one): ?>
                            <li><a href="/lab/<?php echo $one['id']; ?>"><?php echo $one['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class=""><span class="a open_sub">Тести</span>
                        <ul class="sub">
                            <?php foreach($test as $one): ?>
                            <li><a href="/test/<?php echo $one['id']; ?>"><?php echo $one['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class=""><a href="/login<?php echo (!empty($user)?'?logout':''); ?>"><?php echo (!empty($user)?'Вийти':'Увійти'); ?></a></li>
                </ul>
            </nav>
        </header>
        <div class="content row">
            <?php if($is_sub): ?>
            <div class="sitebar col-0 col-sm-5 col-md-4 col-lg-3 col-xl-3">
                <div class="block news row">
                    <h3 class="col-12">Останні оновлення</h3>
                    <ul>
                        <?php $n = 0; foreach($news as $one): if($n++ == 10) break; ?>
                        <li><a href="/<?php echo $one['type']; ?>/<?php echo $one['id']; ?>"><?php echo $one['title']; ?></a> <span class="date">[<?php echo $one['date']; ?>]</span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="block tags row">
                    <h3 class="col-12">Теги</h3>
                    <ul> 
                        <?php foreach($tags as $one): ?>
                        <li><a href="/search/<?php echo $one; ?>"><?php echo $one; ?></a>,</li>
                        <?php endforeach; ?>
                    </ul>
                    <br>
                    <div class="clear"></div>
                </div>
                <div class="block social row">
                    <h3 class="col-12">Поділитись:</h3>
                    <div class="pluso" data-background="transparent" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="facebook,twitter,linkedin,pinterest,bookmark,email,print"></div>
                    <br>
                    <br>
                </div>
            </div>
            <?php endif; ?>
