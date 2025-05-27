<div class="container col-3 pt-3">
    <div class="col-mb-6 offset-mb-3">
        <form action="/register" method="post">
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Имя</label>
                <input name="name" type="text" class="form-control" id="exampleInputName" placeholder="Введите ваше имя">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Введите почту">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label">Подтверждение пароля</label>
                <input name="confirmPassword" type="password" class="form-control" id="exampleInputPassword2" placeholder="Введите пароль еще раз">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>
