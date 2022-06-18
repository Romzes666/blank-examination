<div class="container change-pass">
    <div class="d-flex justify-content-center">
        <div class="card password-card">
            <div class="card-header text-center"><h3>Изменить пароль</h3></div>
            <div class="card-body">
                <form method="post"	id="change_password_form">
                    <div class="form-group text-center">
                        <label>Введите новый пароль</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" />
                    </div>
                    <div class="form-group text-center">
                        <label>Введите новый пароль повторно</label>
                        <input type="password" name="confirm_user_password" id="confirm_user_password" class="form-control" />
                    </div>
                    <div class="form-group text-center mt-3" align="center">
                        <input type="hidden" name="page" value="change_password" />
                        <input type="hidden" name="action" value="change_password" />
                        <input type="submit" name="user_password" id="user_password" class="btn btn-info" value="Изменить" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>