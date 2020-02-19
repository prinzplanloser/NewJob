<?php require_once __DIR__ . '/header.php' ?>


    <div class="container">
        <form action="login" method="post">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInput">Name</label>
                    <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Логин" name="login"
                           value="<?= $_POST['login'] ?? '' ?>">
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInputGroup">Пароль</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Пароль"
                               name="password" value="<?= $_POST['password'] ?? '' ?>">
                    </div>
                </div>
                <div class=" col-auto">
                    <button type="submit" class="btn btn-primary mb-2">Войти</button>
                </div>
            </div>
        </form>
    </div>
<?php require_once __DIR__ . '/footer.php' ?>