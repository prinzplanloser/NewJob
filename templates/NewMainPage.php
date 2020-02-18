<?php require_once __DIR__ . '/header.php' ?>


    <div class="container">

        <table class="table" style="margin: auto">
            <thead class="thead-dark"> <!-- add class="thead-light" for a light header -->

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
                        <select class="form-control-sm custom-select px-1 pagesize" title="Select page size">
                            <option selected="selected" value="3">3</option>
                            <option value="all">All Rows</option>
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
            </tr>


            </thead>
            <tfoot>


            </tfoot>
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


    <br>
    <div class="container">
        <form action="/newTask" class="form-inline my-2 my-lg-0" METHOD="post">
            <input class="form-control mr-sm-2" type="Text" name="name" placeholder="Ваше имя"
                   value="<?= $_POST['name'] ?>">
            <p></p>
            <input class="form-control mr-sm-2" type="email" name="email" placeholder="Ваш Email"
                   value="<?= $_POST['email'] ?>">

            <input style="word-break: break-word" name="text" class="form-control mr-sm-2" type="Text"
                   placeholder="Текст задачи" value="<?= $_POST['text'] ?>">

            <button class="btn btn-info my-2 my-sm-0" type="submit">Создать задачу</button>
        </form>
        <br>
    </div>
<?php require_once __DIR__ . '/footer.php' ?>