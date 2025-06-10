<div class="container col-3 pt-3">
    <div class="col-mb-6 offset-mb-3">
        <form action="/login" method="post">
            <?= getCsrfField() ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                <input name="email" type="text" class="form-control <?= getValidationClass('email') ?>" id="exampleInputEmail1"
                       placeholder="Введите почту" value="<?= old('email') ?>">
                <?= getErrors('email') ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input name="password" type="password" class="form-control <?= getValidationClass('password') ?>" id="exampleInputPassword1"
                       placeholder="Введите пароль">
                <?= getErrors('password') ?>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

    <?php
    session()->remove('formErrors');
    session()->remove('formData');
    ?>
</div>
