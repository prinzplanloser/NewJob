<?php require_once __DIR__ . '/header.php' ?>
    <div style="text-align: center;">
        <h1>Вход</h1>
        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
        <?php endif; ?>
        <form action="newTask" method="post">
            <label> Имя <input type="text" name="name" value="<?= $_POST['name'] ?? '' ?>"></label>
            <br><br>
            <label>Email <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
            <br><br>
            <label style="word-break: break-word">Текст задачи <input type="text" name="text" value="<?= $_POST['text'] ?? '' ?>"></label>
            <button type="submit">Сохранить задачу</button>
        </form>

    </div>

<?php require_once __DIR__ . '/footer.php' ?>