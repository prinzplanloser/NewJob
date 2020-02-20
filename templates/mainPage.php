<?php require_once __DIR__ . '/header.php' ?>


    <div class="container">

        <table class="table" style="margin: auto">
            <thead class="thead-dark">

            <tr>
                <th colspan="7" class="ts-pager">
                    <div class="form-inline">
                        <div class="btn-group btn-group-sm mx-1" role="group">
                            <button type="button" class="btn btn-secondary first" title="first">⇤</button>
                            <button type="button" class="btn btn-secondary prev" title="previous">←</button>
                        </div>
                        <div class="btn-group btn-group-sm mx-1" role="group">
                            <button type="button" class="btn btn-secondary next" title="next">→</button>
                            <button type="button" class="btn btn-secondary last" title="last">⇥</button>
                        </div>
                        <select class="pagesize">
                            <option value="3" selected>3</option>
                        </select>
                        <select class="form-control-sm custom-select px-4 mx-1 pagenum"
                                title="Select page number"></select>
                    </div>
                </th>
            </tr>


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

            <?php /**@var \App\Models\Tasks\Tasks $task */ ?>
            <?php foreach ($pagination as $task): ?>

                <tr>
                    <td><?= htmlspecialchars($task->getName()) ?></td>
                    <td><?= htmlspecialchars($task->getEmail()) ?></td>
                    <td style="word-break: break-word"><?= htmlspecialchars($task->getText()) ?></td>
                    <td><?= $task->getStatus() ?>

                        <?php if ($task->getAdminStatus()): ?>
                            /<strong> <?= $task->getAdminStatus() ?> </strong>
                        <?php endif; ?>
                        <br>
                        <?php if (!empty($user)): ?>
                            <a href="task/<?= $task->getId() ?>">Редактировать</a>

                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <br>

    <div class="container">

        <form action="/newTask" class="form-inline my-2 my-lg-0" METHOD="post">
            <input class="form-control mr-sm-2" type="Text" name="name" placeholder="Ваше имя"
                   value="<?= htmlspecialchars(\App\Services\SessionWrapper\SessionWrapper::handle('name')); ?>"
            >
            <p></p>
            <input class="form-control mr-sm-2" type="email" name="email" placeholder="Ваш Email"
                   value="<?= htmlspecialchars(\App\Services\SessionWrapper\SessionWrapper::handle('email')) ?>">

            <input style="word-break: break-word" name="text" class="form-control mr-sm-2" type="Text"
                   placeholder="Текст задачи"
                   value="<?= htmlspecialchars(\App\Services\SessionWrapper\SessionWrapper::handle('text')) ?>">

            <button class=" btn btn-info my-2 my-sm-0" type="submit">Создать задачу</button>

        </form>
        <br>

    </div>

<?php require_once __DIR__ . '/footer.php' ?>