<?php require_once __DIR__ . '/header.php' ?>


    <div class="container">
        <?php /** @var \App\Models\Tasks\Task $tasks */ ?>
        <table class="table" style="margin: auto">

            <thead class="thead-dark">
            <tr>
                <th class="th-sm">Имя пользователя</th>
                <th class="th-sm">e-mail</th>
                <th class="th-sm">Текст задачи</th>
            </tr>
            </thead>
            <tbody
            <?php /**@var \App\Models\Tasks\Task $task */ ?>
            <?php foreach ($pagination as $task): ?>
                <tr>
                    <td><?= $task->getName() ?></td>
                    <td><?= $task->getEmail() ?></td>
                    <td style="word-break: break-word"><?= $task->getText() ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <br>
        <form action="/newTask" class="form-inline my-2 my-lg-0" METHOD="post">
            <input class="form-control mr-sm-2" type="Text" name="name" placeholder="Ваше имя">
            <p></p>
            <input class="form-control mr-sm-2" type="email" name="email" placeholder="Ваш Email">

            <input style="word-break: break-word" name="text" class="form-control mr-sm-2" type="Text"
                   placeholder="Текст задачи">

            <button class="btn btn-info my-2 my-sm-0" type="submit">Создать задачу</button>
        </form>

    </div>
    <br>
    <div class="container">
        <?php // Проверяем нужны ли стрелки назад
        if ($page != 1) $pervpage = '<a href= /page/1><<</a>
    <a href= /page/' . ($page - 1) . '><</a> ';
        // Проверяем нужны ли стрелки вперед
        if ($page != $total) $nextpage = ' <a href= /page/' . ($page + 1) . '>></a>
    <a href= /page/' . $total . '>>></a>';

        // Находим две ближайшие станицы с обоих краев, если они есть
        if ($page - 2 > 0) $page2left = ' <a href= /page/' . ($page - 2) . '>' . ($page - 2) . '</a> | ';
        if ($page - 1 > 0) $page1left = '<a href= /page/' . ($page - 1) . '>' . ($page - 1) . '</a> | ';
        if ($page + 2 <= $total) $page2right = ' | <a href= /page/' . ($page + 2) . '>' . ($page + 2) . '</a>';
        if ($page + 1 <= $total) $page1right = ' | <a href= /page/' . ($page + 1) . '>' . ($page + 1) . '</a>';

        // Вывод меню
        echo $pervpage . $page2left . $page1left . '<b>' . $page . '</b>' . $page1right . $page2right . $nextpage;

        ?>
    </div>
<?php require_once __DIR__ . '/footer.php' ?>