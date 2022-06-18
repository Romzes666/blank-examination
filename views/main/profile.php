<div class="user-profile">
    <div class="container">
        <div class="intro__inner">
            <div class="d-flex justify-content-center">
                <span id="message"></span>
                <div class="card profile-card">
                    <div class="card-header"><h3>Профиль</h3></div>
                    <div class="card-body">
                        <form method="post" id="profile_form">
                            <div class="form-group">
                                <label>Имя</label>
                                <input type="text" name="user_name" id="user_name"
                                       class="form-control" value="<?= Yii::$app->user->identity->user_name ?>" />
                            </div>
                            <div class="form-group">
                                <label>Фамилия</label>
                                <input type="text" name="user_name" id="user_name"
                                       class="form-control" value="<?= Yii::$app->user->identity->last_name ?>" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="user_address" id="user_address" class="form-control"
                                       value="<?= Yii::$app->user->identity->user_email_address ?>"/>
                            </div>
                            <div class="user-profile-img d-flex flex-column">
                                <label>Изображение профиля</label>
                                <div class="label-img">
                                    <label for="user_image">
                                        <input type="file" name="user_image" id="user_image" accept="image/*"/>
                                        <div class="img-thumbnail">
                                            <i style="font-size: 60px;" class="fas fa-solid fa-file-image"></i>
                                            <img style="display: none" id="user-profile-img" s
                                                 rc="/users_images/<?= Yii::$app->user->identity->user_image ?>" alt=""/>
                                        </div>
                                    </label>
                                </div>
                                <input type="hidden" name="hidden_user_image" value="<?= Yii::$app->user->identity->user_image ?>" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>