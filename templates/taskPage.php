<?php require_once __DIR__ . '/taskHeader.php' ?>
<?php /**@var \App\Models\Tasks\Tasks $task */ ?>

    <div class="container">
        <form action="/task/<?= $task->getId() ?>" method="post">
            <table class="table" style="margin: auto">
                <thead class="thead-dark">

                <tr>
                    <th>Имя пользователя</th>
                    <th>e-mail</th>
                    <th>Текст задачи</th>
                    <th>Статус</th>
                </tr>

                </thead>
                <tfoot>

                </tfoot>
                <tbody>

                <tr>
                    <td><input type="text" name="name" value="<?= htmlspecialchars($task->getName()) ?>">
                    </td>
                    <td><input type="text" name="email" value="<?= htmlspecialchars($task->getEmail()) ?>">
                    </td>
                    <td><input type="text" name="text" value="<?= htmlspecialchars($task->getText()) ?>">
                    </td>

                    <td>
                        <select name="status">
                            <option>Выполнено</option>
                            <option>Не выполнено</option>
                        </select>

                    </td>
                </tr>

                </tbody>
            </table>
            <button type="submit"> Отправить форму</button>
        </form>
    </div>



<?php require_once __DIR__ . '/footer.php' ?>