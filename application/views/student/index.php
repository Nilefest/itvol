<?php echo $header; ?>
<div class="article col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <h1>Особистий кабінет студента</h1>
    <p>На цій сторінці ви можете переглядати результати тестів, які ви виконали</p>
    <table>
        <tr>
            <th>#</th>
            <th>Дата</th>
            <th>Назва тесту</th>
            <th>Результати</th>
            <th></th>
        </tr>
        <?php $n = 1; foreach($statistic as $stat): ?>
        <tr>
            <td><?php echo $n++; ?></td>
            <td><?php echo $stat['date']; ?></td>
            <td><a href="/test/<?php echo $stat['test_id']; ?>"><?php echo $tests[$stat['test_id']]['title']; ?></a></td>
            <td><?php echo $stat['mark'] . ' / ' . $stat['mark_all']; ?></td>
            <td><a class="file red" href="/student?rem_stat=<?php echo $stat['id']; ?>">Видалити</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php echo $footer ?>