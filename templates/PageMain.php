<?php require_once __DIR__ . '/header.php' ?>
    <div style="text-align: center;">
        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
        <?php endif; ?>
    </div>

    <style>


        .table table {
            border-collapse: collapse;
        }

        .table th {
            color: #ffebcd;
            background: #008b8b;
            cursor: pointer;
        }

        .table td,
        .table th {
            width: 150px;
            height: 40px;
            text-align: center;
            border: 2px solid #846868;
        }

        .table tbody tr:nth-child(even) {
            background: #e3e3e3;
        }

        th.sorted[data-order="1"],
        th.sorted[data-order="-1"] {
            position: relative;
        }

        th.sorted[data-order="1"]::after,
        th.sorted[data-order="-1"]::after {
            right: 8px;
            position: absolute;
        }

        th.sorted[data-order="-1"]::after {
            content: "▼"
        }

        th.sorted[data-order="1"]::after {
            content: "▲"
        }


    </style>
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
            <tbody>
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
    </div>
    <a href="/newTask">Создать новую задачу</a>
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


<?php require_once __DIR__ . '/footer.php' ?>