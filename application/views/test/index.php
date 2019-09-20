<?php echo $header; /*(<?php echo $quest['true_this'] . ' / ' . $quest['false_this'] . ' / ' . $quest['true_all']; ?>)*/ ?>
<style>
    .ans_status_0,
    .ans_status_1,
    .ans_status_2{
    font-style: italic;
    font-weight: 600;
    }
.ans_status_0{
    color: #a00;
    }
.ans_status_1{
    color: #0a0;
    }
.ans_status_2{
    color: #aa0;
    }
</style>
<div class="article col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9">
    <h1><?php echo $test['name']; ?> <?php echo $test['title']; ?></h1>
    <h2>Коротка інформація щодо тесту.</h2>
    <p><?php echo $test['description']; ?></p>
    <form action="" method="post">
        <?php $n = 1; foreach($test_question as $key_ans => $quest): ?>
        
        <h4><b><span class="ans_status_<?php echo $quest['status']; ?>"><?php echo ($quest['status'] == '0' ? 'НІ. ' : ($quest['status'] == '1' ? 'ТАК. ' : ($quest['status'] == '2' ? 'ЧАСТКОВО. ' : ''))); ?></span>Запитання <?php echo $n++; ?>.</b> <?php echo $quest['question']; ?></h4>
        <?php foreach($quest['answers'] as $ans): if(isset($testing) && $testing['ask' . $quest['id']]) $is_sel = (in_array($ans['id'], $testing['ask' . $quest['id']]) ? 'checked' : '');?>
        <div style="display: flex; justify-content: center;">
            <input style="" <?php echo ($ans['is_check'] == 1 ? 'checked' : ''); ?> type="<?php echo $quest['type']?>" name="<?php echo $ans['id']; ?>" value="<?php echo $ans['id']; ?>" id='ask_<?php echo $quest['id']; ?>_<?php echo $ans['id']; ?>'>
            <label style="background-color:#<?php if($ans['is_check'] == '1') echo $ans['color']; ?>; padding: 1px 5px; width:80%;" for="ask_<?php echo $quest['id']; ?>_<?php echo $ans['id']; ?>"> <?php echo $ans['value']; ?></label><br>
        </div>
        
        <?php endforeach; endforeach; if($lvl): ?>
        <input type="hidden" name="test_id" value="<?php echo $test['id']; ?>">
        <input type="submit" name="sub_test" value="Перевірити">
        <?php endif; ?>
    </form>
</div>
<?php if($testing_rezult): ?>
<script>
    alert('Ваш результат: <?php echo $testing_rezult; ?>. Бажаємо успіхів!');
</script>
<?php endif; ?>
<?php echo $footer ?>